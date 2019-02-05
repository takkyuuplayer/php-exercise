<?php


use Phinx\Migration\AbstractMigration;

class MyFirstMigration extends AbstractMigration
{
    public function up()
    {
        $this->execute("CREATE DATABASE IF NOT EXISTS tutorial DEFAULT CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'");

        $this->execute('CREATE TABLE IF NOT EXISTS news (
            id int(11) NOT NULL AUTO_INCREMENT,
            title varchar(128) NOT NULL,
            slug varchar(128) NOT NULL,
            text text NOT NULL,
            PRIMARY KEY (id),
            KEY slug (slug)
        )');
        $this->execute("INSERT INTO news (
            title,
            slug,
            text
        ) VALUES
        ('hello', 'hello', 'world'),
        ('こんにちは', 'konnichiwa', '世界')
        ");
    }
}
