<?php

namespace DTS\eBaySDK\Test\Trading\Enums;

use DTS\eBaySDK\Trading\Enums\ResponsiblePersonCodeType;

class ResponsiblePersonCodeTypeTest extends \PHPUnit_Framework_TestCase
{
    private $obj;

    protected function setUp()
    {
        $this->obj = new ResponsiblePersonCodeType();
    }

    public function testCanBeCreated()
    {
        $this->assertInstanceOf('\DTS\eBaySDK\Trading\Enums\ResponsiblePersonCodeType', $this->obj);
    }

    public function testEuResponsiblePersonValue()
    {
        $this->assertSame('EUResponsiblePerson', ResponsiblePersonCodeType::C_EU_RESPONSIBLE_PERSON);
    }
}
