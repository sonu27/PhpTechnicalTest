<?php
namespace Amara;

class FeefoReview
{
    const CACHE_KEY = 'feefo_review';
    const CACHE_TTL = 86400; // 24 hours
    const URL = 'http://www.feefo.com/feefo/xmlfeed.jsp?logon=www.amara.co.uk&limit=1&vendorref=';

    private $cache;

    public function __construct(\Redis\ClientInterface $cache)
    {
        $this->cache = $cache;
    }

    public function get($productId)
    {
        $key  = self::CACHE_KEY.'_'.intval($productId);
        $data = $this->cache->getAndSetIfNotExists($key, [$this, 'getFromApi'], [$productId], self::CACHE_TTL);

        return json_decode($data, true);
    }

    public function getFromApi($productId)
    {
        $xml = simplexml_load_file(self::URL.intval($productId));

        $data = [
            'count'   => $xml->SUMMARY->COUNT->__toString(),
            'average' => $xml->SUMMARY->AVERAGE->__toString(),
        ];

        return json_encode($data);
    }

    public function deleteAll()
    {
        return $this->cache->deleteAllKeysBeginningWith(self::CACHE_KEY);
    }
}
