<?php
require_once __DIR__ . '/Reporter.php';
require_once __DIR__ . '/Assertions.php';

class TestSuite
{
    private string $name;
    private array $tests = [];
    private $beforeEach;
    private $afterEach;
    private int $total = 0;
    private int $passed = 0;
    private int $failed = 0;
    private Reporter $reporter;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->reporter = new Reporter();
    }

    public function beforeEach(callable $fn): void
    {
        $this->beforeEach = $fn;
    }
    public function afterEach(callable $fn): void
    {
        $this->afterEach = $fn;
    }

    public function add(string $testName, callable $fn): void
    {
        $this->tests[$testName] = $fn;
    }

    public function run(): void
    {
        $this->reporter->header("Suite: {$this->name}");
        foreach ($this->tests as $name => $fn) {
            $this->total++;
            try {
                if ($this->beforeEach) {
                    ($this->beforeEach)();
                }
                $fn();
                if ($this->afterEach) {
                    ($this->afterEach)();
                }

                $this->reporter->success("$name passou");
                $this->passed++;
            } catch (AssertionError $e) {
                $this->reporter->fail("$name falhou: " . $e->getMessage());
                $this->failed++;
            } catch (Exception $e) {
                $this->reporter->error("$name erro: " . $e->getMessage());
                $this->failed++;
            }
        }

        $this->reporter->header("Resumo da Suite {$this->name}");
        echo "Total: {$this->total} | "
            . "Passaram: {$this->passed} | "
            . "Falharam: {$this->failed}\n";
    }
}
