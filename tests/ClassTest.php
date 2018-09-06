<?php

use PHPUnit\Framework\TestCase;

class ParentClass
{
    public $public;
    protected $protected;
    private $private;
    private $private2;

    public static $val = 10;
    public static $val2 = 100;

    public function __construct()
    {
        $this->public = 1;
        $this->protected = 1;
        $this->private = 1;
        $this->private2 = 1;
    }

    public function counter()
    {
        static $val = 0;

        return $val++;
    }

    public function counter2()
    {
        return static::$val++;
    }

    public function counter3()
    {
        return self::$val2++;
    }
}

class ChildClass extends ParentClass
{
    protected $private2;
    private static $static_private = 3;
}

class ClassTest extends TestCase
{
    public function testVisibility()
    {
        $k = new ChildClass();

        $this->assertSame(1, $k->public);

        Closure::bind(
            function () use ($k) {
                $this->assertSame(1, $k->protected, 'Access to parent protected variable');
                $this->assertFalse(isset($k->private), 'Cannot access to parent private variable');
                $this->assertNull($k->private2, 'Cannot override private variable');
                $this->assertSame(3, ChildClass::$static_private);
            },
            $this,
            'ChildClass'
        )->__invoke();
    }

    public function testMethodStaticValue()
    {
        $p = new ParentClass();

        $this->assertSame(0, $p->counter());
        $this->assertSame(1, $p->counter());

        $p2 = new ParentClass();

        $this->assertSame(2, $p2->counter());
        $this->assertSame(3, $p2->counter());

        $c = new ChildClass();

        $this->assertSame(0, $c->counter());
        $this->assertSame(1, $c->counter());
    }

    public function testClassStaticValue()
    {
        $k = new ParentClass();

        $this->assertSame(10, $k->counter2());
        $this->assertSame(11, $k->counter2());

        $k2 = new ParentClass();

        $this->assertSame(12, $k->counter2());
        $this->assertSame(13, $k->counter2());

        $c = new ChildClass();

        $this->assertSame(14, $c->counter2());
        $this->assertSame(15, $c->counter2());
    }
}
