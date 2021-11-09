<?php
namespace DTS\eBaySDK\Test\Mocks;

class BaseService extends \DTS\eBaySDK\Services\BaseService
{
    public function __construct(array $config)
    {
        parent::__construct('http://production.com', 'http://sandbox.com', $config);
    }

    protected function getEbayHeaders($operationName)
    {
        return ['fooHdr' => $operationName];
    }
}
