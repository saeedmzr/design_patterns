<?php

// Timer Decorator
function timerDecorator(callable $func): callable {
    return function(...$args) use ($func) {
        $startTime = microtime(true); // Record the start time
        $result = $func(...$args); // Call the original function
        $endTime = microtime(true); // Record the end time
        $executionTime = $endTime - $startTime;

        // Use the function name or a generic description
        $funcName = is_string($func) ? $func : 'Function';
        echo "$funcName took " . number_format($executionTime, 4) . " seconds to execute.\n";
        return $result;
    };
}

// Timeout Decorator (using pcntl for timeout)
function timeoutDecorator(int $maxTime): callable {
    return function(callable $func) use ($maxTime): callable {
        return function(...$args) use ($func, $maxTime) {
            // Fork the process
            $pid = pcntl_fork();

            if ($pid == -1) {
                // Fork failed
                throw new Exception("Could not fork process");
            } elseif ($pid == 0) {
                // Child process: execute the function
                $result = $func(...$args);
                exit(0); // Exit the child process
            } else {
                // Parent process: wait for the child process or timeout
                $status = null;
                $startTime = time();

                while (true) {
                    // Check if the child process has finished
                    $res = pcntl_waitpid($pid, $status, WNOHANG);

                    if ($res == -1 || $res > 0) {
                        // Child process has finished
                        break;
                    }

                    // Check if the maximum time has been exceeded
                    if (time() - $startTime >= $maxTime) {
                        // Timeout: kill the child process
                        posix_kill($pid, SIGKILL);
                        throw new Exception("Function exceeded maximum execution time of $maxTime seconds");
                    }

                    // Sleep for a short time to avoid busy-waiting
                    usleep(100000); // 100ms
                }

                // Check if the child process exited normally
                if (pcntl_wifexited($status)) {
                    return $result;
                } else {
                    throw new Exception("Function did not complete successfully");
                }
            }
        };
    };
}

// Example Functions

// Function to measure execution time
$exampleFunc = timerDecorator(function(int $n) {
    sleep($n);
    echo "Function executed.\n";
});

// Function to enforce timeout
$exampleFunc2 = timeoutDecorator(2)(function(int $n) {
    sleep($n);
    echo "Function executed.\n";
});

// Main Execution
try {
    $exampleFunc(2); // Should execute successfully
    $exampleFunc2(7); // Should throw a timeout exception
} catch (Exception $e) {
    echo $e->getMessage() . "\n";
}