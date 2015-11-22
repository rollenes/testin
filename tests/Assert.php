<?php

namespace TestIn\Tests;

class Assert
{
    public static function same($got, $expected)
    {
        if ($got !== $expected) {
            throw new \Exception("\nExpecting: \n$expected\nGot:\n" . $got . "\n");
        }
    }
}