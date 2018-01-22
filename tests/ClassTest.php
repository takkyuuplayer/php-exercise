<?php
use PHPUnit\Framework\TestCase;

class ParentClass
{
    public $public;
    protected $protected;
    private $private;
    private $private2;

    public function __construct()
    {
        $this->public = 1;
        $this->protected = 1;
        $this->private = 1;
        $this->private2 = 1;
    }
}

class ChildClass extends ParentClass
{
    protected $private2;
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
            },
            $this,
            'ChildClass'
        )->__invoke();
    }
}
