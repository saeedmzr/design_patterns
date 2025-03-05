<?php


class FibonacciGenerator
{
    /**
     * Generate Fibonacci sequence up to a given limit.
     *
     * @param int $limit The maximum number in the sequence.
     * @return Generator
     */
    public function generateFibonacci(int $limit): Generator
    {
        $a = 0;
        $b = 1;

        while ($a <= $limit) {
            yield $a; // Yield the current Fibonacci number
            list($a, $b) = [$b, $a + $b]; // Update values for the next iteration
        }
    }
}

// Usage
$fibonacciGenerator = new FibonacciGenerator();
$limit = 100; // Generate Fibonacci numbers up to 100

foreach ($fibonacciGenerator->generateFibonacci($limit) as $number) {
    echo $number . PHP_EOL;
}