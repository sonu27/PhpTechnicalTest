<?php
namespace AppBundle\Service;

interface CacheInterface
{
    public function getAndSetIfNotExists($key, $function, $ttl = 300);
}
