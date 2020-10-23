<?php

use Wuan\PhpDefer\Defer;
use Symfony\Component\Console\Output\OutputInterface;


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
    /**
     * @param OutputInterface $output
     */
    function console_exec_time (OutputInterface $output): void {
        $startTime = time();
        $closure = function () use ($startTime, $output) {
            $useTime = time() - $startTime;
            return $output->writeln("用时: ".$useTime.' 秒');
        };
        \defer($closure);
    }
}


if (!function_exists('console_exec_memory')) {
    /**
     * @param OutputInterface $output
     */
    function console_exec_memory (OutputInterface $output): void {
        $startMemory = memory_get_usage();
        $closure = function () use ($startMemory, $output) {
            $useMemory = round((memory_get_usage() - $startMemory) / 1024 / 1024, 2);
            return $output->writeln("内存使用: ".$useMemory.' MB');
        };
        \defer($closure);
    }
}
