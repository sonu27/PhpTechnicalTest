<?php
namespace Redis;

interface ClientInterface
{
    public function getAndSetIfNotExists($key, $function, $ttl = 300);

    public function deleteAllKeysBeginningWith($prefix);

    public function keys($search);

    public function del($key);
}
