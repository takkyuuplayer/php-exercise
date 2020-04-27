<?php

use PHPUnit\Framework\TestCase;

class PDOTest extends TestCase
{
    private $dbh;

    public function setUp(): void
    {
        $this->dbh = new \PDO('mysql:host=mysql-server;dbname=test', 'testuser', 'testpass');
        $this->dbh->exec(
            <<<'SQL'
CREATE TABLE IF NOT EXISTS `kouza` (
    `user_id` INT UNSIGNED NOT NULL,
    `balance` INT UNSIGNED NOT NULL,
    PRIMARY KEY (`user_id`)
);
TRUNCATE `kouza`;
SQL
        );
    }

    public function testAssetInstance()
    {
        $this->assertInstanceOf('\PDO', $this->dbh);
    }

    public function testCRUD()
    {
        // Create
        $stmt = $this->dbh->prepare('INSERT INTO kouza VALUES (?, ?)');

        $this->assertTrue($stmt->execute([1, 10000]));
        $this->assertTrue($stmt->execute([2, 100000]));

        // Read
        $stmt = $this->dbh->prepare('SELECT * FROM kouza');
        $stmt->execute();

        $this->assertEquals(
            [
            ['user_id' => 1, 'balance' => 10000],
            ['user_id' => 2, 'balance' => 100000],
            ], $stmt->fetchAll(\PDO::FETCH_ASSOC)
        );

        // UPDATE
        $stmt = $this->dbh->prepare('UPDATE kouza SET balance = ? WHERE user_id = ?');

        $this->assertTrue($stmt->execute([5000, 1]));
        $this->assertTrue($stmt->execute([105000, 2]));

        // Read
        $stmt = $this->dbh->prepare('SELECT * FROM kouza');
        $stmt->execute();

        $this->assertEquals(
            [
            ['user_id' => 1, 'balance' => 5000],
            ['user_id' => 2, 'balance' => 105000],
            ], $stmt->fetchAll(\PDO::FETCH_ASSOC)
        );

        // Delete
        $stmt = $this->dbh->prepare('DELETE FROM kouza WHERE user_id = ?');

        $this->assertTrue($stmt->execute([1]));

        // Read
        $stmt = $this->dbh->prepare('SELECT * FROM kouza');
        $stmt->execute();

        $this->assertEquals(
            [
            ['user_id' => 2, 'balance' => 105000],
            ], $stmt->fetchAll(\PDO::FETCH_ASSOC)
        );
    }
}
