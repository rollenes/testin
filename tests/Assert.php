<?php

namespace TestIn\Tests;

class Assert
{
    public static function same($got, $expected)
    {
        if ($got !== $expected) {
            throw new \Exception(
                "\n".
                "Expecting: \n" .
                print_r($expected, true) ."\n" .
                "Got:\n" .
                print_r($got, true) .
                "\n"
            );
        }
    }

    public static function like($got, $expected)
    {
        if ($got != $expected) {
            throw new \Exception(
                "\n".
                "Expecting: \n" .
                print_r($expected, true) ."\n" .
                "Got:\n" .
                print_r($got, true) .
                "\n"
            );
        }
    }
}