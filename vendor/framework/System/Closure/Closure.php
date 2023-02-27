<?php 

namespace Lynx\System\Closure;

class Closure
{
    private $callback;

    public function __construct(callable $callback)
    {
        $this->callback = $callback;
    }

    public function __invoke(...$args)
    {
        return call_user_func_array($this->callback, $args);
    }
}
