<?php
namespace AppBundle\Service;

class Redis implements CacheInterface
{
    private $redis;

    public function __construct($redis)
    {
        $this->redis = $redis;
    }

    public function getAndSetIfNotExists($key, $callable, $paramArray = null, $ttl = 1200)
    {
        $value = $this->redis->get($key);

        if ($value !== null) {
            return $value;
        }

        if (is_callable($callable)) {
            $value = call_user_func_array($callable, $paramArray);

            if ($value !== null) {
                $this->redis->setex($key, $ttl, $value);
            }
        }

        return $value;
    }

    public function keys($search)
    {
        return $this->redis->keys($search);
    }

    public function del($key)
    {
        return $this->redis->del($key);
    }

    public function __call($method, $arguments)
    {
        return call_user_func_array([$this->redis, $method], $arguments);
    }
}
