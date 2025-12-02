<?php
class Assertions
{
    public static function equal($a, $b, string $msg = '')
    {
        if ($a !== $b) {
            throw new AssertionError($msg ?: "Esperado $a === $b");
        }
    }

    public static function true($cond, string $msg = '')
    {
        if (!$cond) {
            throw new AssertionError($msg ?: "Esperado condição verdadeira");
        }
    }
}
