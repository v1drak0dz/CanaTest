<?php
class Reporter
{
    private string $green = "\033[32m";
    private string $red   = "\033[31m";
    private string $yellow = "\033[33m";
    private string $cyan  = "\033[36m";
    private string $reset = "\033[0m";

    public function success(string $msg)
    {
        echo $this->green . "✅ $msg" . $this->reset . "\n";
    }

    public function fail(string $msg)
    {
        echo $this->red . "❌ $msg" . $this->reset . "\n";
    }

    public function error(string $msg)
    {
        echo $this->yellow . "⚠️ $msg" . $this->reset . "\n";
    }

    public function header(string $msg)
    {
        echo $this->cyan . "=== $msg ===" . $this->reset . "\n";
    }
}
