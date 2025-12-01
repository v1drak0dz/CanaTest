<?php
class TestSuite
{
    private string $name;
    private array $tests = [];
    private $beforeEach;
    private $afterEach;
    private int $total = 0;
    private int $passed = 0;
    private int $failed = 0;

    // Códigos ANSI para cores
    private string $green = "\033[32m";
    private string $red   = "\033[31m";
    private string $yellow = "\033[33m";
    private string $cyan  = "\033[36m";
    private string $reset = "\033[0m";

    public function __construct(string $name)
    {
        $this->name = $name;
        assert_options(ASSERT_ACTIVE, 1);
        assert_options(ASSERT_EXCEPTION, 1);
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
        echo $this->cyan . "=== Suite: {$this->name} ===" . $this->reset . "\n";
        foreach ($this->tests as $name => $fn) {
            $this->total++;
            try {
                if ($this->beforeEach) {
                    ($this->beforeEach)();
                }

                $fn(); // roda o teste

                if ($this->afterEach) {
                    ($this->afterEach)();
                }

                echo $this->green . "✅ {$name} passou" . $this->reset . "\n";
                $this->passed++;
            } catch (AssertionError $e) {
                echo $this->red . "❌ {$name} falhou: " . $e->getMessage() . $this->reset . "\n";
                $this->failed++;
            } catch (Exception $e) {
                echo $this->yellow . "⚠️ {$name} erro: " . $e->getMessage() . $this->reset . "\n";
                $this->failed++;
            }
        }

        // Mensagem final
        echo "\n" . $this->cyan . "=== Resumo da Suite {$this->name} ===" . $this->reset . "\n";
        echo "Total: {$this->total} | "
            . $this->green . "Passaram: {$this->passed}" . $this->reset . " | "
            . $this->red   . "Falharam: {$this->failed}" . $this->reset . "\n";
    }
}
