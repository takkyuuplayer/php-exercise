<?php
namespace Test\Illuminate\Database\Query;

use Closure;

class DummyConnection implements \Illuminate\Database\ConnectionInterface
{
    public function table($table)
    {
        throw new \Exception('This is dummy connection!! You cannot call table');
    }

    public function raw($value)
    {
        throw new \Exception('This is dummy connection!! You cannot call raw');
    }

    public function selectOne($query, $bindings = [])
    {
        throw new \Exception('This is dummy connection!! You cannot call selectOne');
    }

    public function select($query, $bindings = [])
    {
        throw new \Exception('This is dummy connection!! You cannot call select');
    }

    public function insert($query, $bindings = [])
    {
        throw new \Exception('This is dummy connection!! You cannot call insert');
    }


    public function update($query, $bindings = [])
    {
        throw new \Exception('This is dummy connection!! You cannot call update');
    }


    public function delete($query, $bindings = [])
    {
        throw new \Exception('This is dummy connection!! You cannot call delete');
    }

    public function statement($query, $bindings = [])
    {
        throw new \Exception('This is dummy connection!! You cannot call statement');
    }

    public function affectingStatement($query, $bindings = [])
    {
        throw new \Exception('This is dummy connection!! You cannot call affectingStatement');
    }

    public function unprepared($query)
    {
        throw new \Exception('This is dummy connection!! You cannot call unprepared');
    }

    public function prepareBindings(array $bindings)
    {
        throw new \Exception('This is dummy connection!! You cannot call prepareBindings');
    }

    public function transaction(Closure $callback, $attempts = 1)
    {
        throw new \Exception('This is dummy connection!! You cannot call transaction');

        return 1;
    }

    public function beginTransaction()
    {
        throw new \Exception('This is dummy connection!! You cannot call beginTransaction');
    }

    public function commit()
    {
        throw new \Exception('This is dummy connection!! You cannot call commit');
    }

    public function rollBack()
    {
        throw new \Exception('This is dummy connection!! You cannot call rollBack');
    }

    public function transactionLevel()
    {
        throw new \Exception('This is dummy connection!! You cannot call transactionLevel');
    }


    public function pretend(Closure $callback)
    {
        throw new \Exception('This is dummy connection!! You cannot call pretend');
    }
}


use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\Grammars\PostgresGrammar;
use Illuminate\Database\Query\Processors\PostgresProcessor;

class BuilderTest extends \PHPUnit\Framework\TestCase
{
    private $builder = null;

    public function setUp()
    {
      $this->builder = new Builder(
        new DummyConnection(),
        new PostgresGrammar(),
        new PostgresProcessor()
      );
    }

    public function testCreateInstance()
    {
      $this->assertInstanceOf('Illuminate\Database\Query\Builder', $this->builder);
    }

    public function testWhere()
    {
        $this->builder->from('user')
            ->where('id', '=', 1);

        $this->assertSame('select * from "user" where "id" = ?', $this->builder->toSql());
        $this->assertSame([1], $this->builder->getBindings());
    }
}
