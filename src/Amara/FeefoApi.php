<?php
namespace Amara;

class FeefoApi
{
    const URL = 'http://www.feefo.com/feefo/xmlfeed.jsp?logon=www.amara.co.uk&limit=1&vendorref=';

    private $httpClient;

    public function __construct(\GuzzleHttp\ClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function getReviews($productId)
    {
        $response = $this->httpClient->get(self::URL.intval($productId));
        $xml      = simplexml_load_string($response->getBody());

        $data = [];
        if (isset($xml->SUMMARY->COUNT, $xml->SUMMARY->AVERAGE)) {
            $data = [
                'count'   => $xml->SUMMARY->COUNT->__toString(),
                'average' => $xml->SUMMARY->AVERAGE->__toString(),
            ];
        }

        return json_encode($data);
    }
}
