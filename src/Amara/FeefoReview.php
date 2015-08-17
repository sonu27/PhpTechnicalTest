<?php
namespace Amara;

class FeefoReview
{
    const CACHE_KEY = 'feefo_review';
    const CACHE_TTL = 86400; // 24 hours

    private $api;
    private $cache;

    public function __construct(\Redis\ClientInterface $cache, FeefoApi $api)
    {
        $this->api = $api;
        $this->cache = $cache;
    }

    public function get($productId)
    {
        $key  = self::CACHE_KEY.'_'.intval($productId);
        $data = $this->cache->getAndSetIfNotExists($key, [$this->api, 'getReviews'], [$productId], self::CACHE_TTL);

        return json_decode($data, true);
    }

    public function deleteAll()
    {
        return $this->cache->deleteAllKeysBeginningWith(self::CACHE_KEY);
    }
}
