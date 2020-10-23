<?php

use Wuan\PhpDefer\Defer;
use Symfony\Component\Console\Output\ConsoleOutput;


if (!function_exists('defer')) {
    /**
     * @param Closure $closure
     * @return Defer
     */
    function defer (\Closure $closure) {
        $defer = new Defer();
        $defer->pushClosure($closure);
        return $defer;
    }
}

if (!function_exists('console_exec_time')) {
    function console_exec_time (): void {
        $startTime = time();
        $output = new ConsoleOutput();
        $closure = function () use ($startTime, $output) {
            $useTime = time() - $startTime;
            $output->writeln("用时: ".$useTime.' 秒');
        };
        \defer($closure);
    }
}


if (!function_exists('console_exec_memory')) {
    function console_exec_memory (): void {
        $startMemory = memory_get_usage();
        $output = new ConsoleOutput();
        $closure = function () use ($startMemory, $output) {
            $useMemory = round((memory_get_usage() - $startMemory) / 1024 / 1024, 2);
            $output->writeln("内存使用: ".$useMemory.' MB');
        };
        \defer($closure);
    }
}
