<?php

namespace Wuan\PhpDefer;

use Closure;

class Defer {
    protected array $closures = [];

    /**
     * @param Closure $closure
     */
    public function pushClosure (Closure $closure) {
        array_push($this->closures, $closure);
    }


    /**
     * __destruct
     */
    public function __destruct () {
        foreach (array_reverse($this->closures) as $closure) {
            $closure();
        }
    }
}