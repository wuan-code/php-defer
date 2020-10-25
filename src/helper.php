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
    /**
     * @param string $consoleName
     */
    function console_exec_time (string $consoleName = ''): void {
        $startTime = time();
        $output = new ConsoleOutput();
        $closure = function () use ($consoleName, $startTime, $output) {
            $useTime = time() - $startTime;
            $output->writeln("<info>{$consoleName} 处理用时: {$useTime} 秒 </info>");
        };
        \defer($closure);
    }
}


if (!function_exists('console_exec_memory')) {
    /**
     * @param string $consoleName
     */
    function console_exec_memory (string $consoleName = ''): void {
        $startMemory = memory_get_usage();
        $output = new ConsoleOutput();
        $closure = function () use ($consoleName, $startMemory, $output) {
            $useMemory = round((memory_get_usage() - $startMemory) / 1024 / 1024, 2);
            $output->writeln("<info>{$consoleName} 内存使用: {$useMemory} MB</info>");
        };
        \defer($closure);
    }
}


if (!function_exists('echo_exec_time')) {
    /**
     * @param string $consoleName
     */
    function echo_exec_time (string $consoleName = ''): void {
        $startTime = time();
        $closure = function () use ($consoleName, $startTime) {
            $useTime = time() - $startTime;
            echo "{$consoleName} 处理用时: {$useTime} 秒 ";
        };
        \defer($closure);
    }
}


if (!function_exists('echo_exec_memory')) {
    /**
     * @param string $consoleName
     */
    function echo_exec_memory (string $consoleName = ''): void {
        $startMemory = memory_get_usage();
        $closure = function () use ($consoleName, $startMemory) {
            $useMemory = round((memory_get_usage() - $startMemory) / 1024 / 1024, 2);
            echo "{$consoleName} 内存使用: {$useMemory} MB";
        };
        \defer($closure);
    }
}

