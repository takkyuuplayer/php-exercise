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

    public function selectOne($query, $bindings = [], $useReadPdo = true)
    {
        throw new \Exception('This is dummy connection!! You cannot call selectOne');
    }

    public function select($query, $bindings = [], $useReadPdo = true)
    {
        throw new \Exception('This is dummy connection!! You cannot call select');
    }

    public function cursor($query, $bindings = [], $useReadPdo = true)
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
use Illuminate\Database\Query\Grammars\PostgresGrammar as Grammar;
use Illuminate\Database\Query\Processors\PostgresProcessor as Processor;

class BuilderTest extends \PHPUnit\Framework\TestCase
{
    private $builder = null;

    public function setUp()
    {
        $this->builder = new Builder(
            new DummyConnection(),
            new Grammar(),
            new Processor()
        );
    }

    public function testCreateInstance()
    {
        $this->assertInstanceOf('Illuminate\Database\Query\Builder', $this->builder);
    }

    public function testWhere()
    {
        $this->builder->from('user')
            ->where('id', '=', 1)
            ->where(
                [
                ['email', '=', '1@test.com'],
                ['email', '=', '2@test.com', 'or'],
                ]
            );

        $this->assertSame('select * from "user" where "id" = ? and ("email" = ? or "email" = ?)', $this->builder->toSql());
        $this->assertSame([1, '1@test.com', '2@test.com'], $this->builder->getBindings());
    }

    public function testOrWhere()
    {
        $this->builder->from('user')
            ->where('id', '=', 1)
            ->orWhere(
                [
                ['email', '=', '1@test.com'],
                [function ($query) {
                    $query->whereNull('email');
                }, null, null, 'or'],
                ]
            );

        $this->assertSame('select * from "user" where "id" = ? or ("email" = ? or ("email" is null))', $this->builder->toSql());
    }

    public function testJoin()
    {
        $this->builder->from('user')
            ->leftJoin('user_signup_route', 'user.id', '=', 'user_signup_route.user_id')
            ->where('user.id', '=', 1);

        $this->assertSame('select * from "user" left join "user_signup_route" on "user"."id" = "user_signup_route"."user_id" where "user"."id" = ?', $this->builder->toSql());
    }
}
