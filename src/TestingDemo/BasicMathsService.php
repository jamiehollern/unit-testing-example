<?php

namespace TestingDemo;

/**
 * Class BasicMathsService
 * @package TestingDemo
 */
final class BasicMathsService
{

    /**
     * Adds two given numbers together.
     *
     * @param int $a
     * @param int $b
     * @return int
     */
    public function addNumbers(int $a, int $b): int
    {
        return $a + $b;
    }

    /**
     * Subtracts the first number from the second.
     *
     * @param int $a
     * @param int $b
     * @return int
     */
    public function subtractNumbers(int $a, int $b): int
    {
        return $a - $b;
    }

}
