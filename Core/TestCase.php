<?php
require_once __DIR__ . '/TestSuite.php';
require_once __DIR__ . '/Assertions.php';

abstract class TestCase
{
    protected TestSuite $suite;

    public function __construct(string $name)
    {
        $this->suite = new TestSuite($name);
    }

    // Atalho para adicionar testes
    protected function test(string $name, callable $fn): void
    {
        $this->suite->add($name, $fn);
    }

    // Hooks
    protected function beforeEach(callable $fn): void
    {
        $this->suite->beforeEach($fn);
    }

    protected function afterEach(callable $fn): void
    {
        $this->suite->afterEach($fn);
    }

    // Rodar suite
    public function run(): void
    {
        $this->suite->run();
    }
}
