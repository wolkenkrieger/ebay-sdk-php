<?php
namespace DTS\eBaySDK\Test\Mocks;

class Service extends \DTS\eBaySDK\Test\Mocks\BaseService
{
    public function __construct(array $config)
    {
        parent::__construct(
            $config + [
                'credentials' => [
                    'appId' => '',
                    'certId' => '',
                    'devId' => ''
                ]
            ]
        );
    }

    public function foo(\DTS\eBaySDK\Test\Mocks\ComplexClass $request)
    {
        return $this->callOperationAsync(
            'foo',
            $request,
            '\DTS\eBaySDK\Test\Mocks\ComplexClass'
        )->wait();
    }

    public function bar(\DTS\eBaySDK\Test\Mocks\ComplexClass $request)
    {
        return $this->callOperationAsync(
            'foo',
            $request,
            '\DTS\eBaySDK\Test\Mocks\ComplexClass'
        )->wait();
    }
}
