<?php
namespace DTS\eBaySDK\Test\Browse\Services;

use DTS\eBaySDK\Browse\Services\BrowseBaseService;
use DTS\eBaySDK\Browse\Services\BrowseService;
use DTS\eBaySDK\Test\Browse\Mocks\Service;
use DTS\eBaySDK\Test\Mocks\HttpRestHandler;

class ServiceTest extends \PHPUnit_Framework_TestCase
{
    public function testConfigDefinitions()
    {
        $d = BrowseBaseService::getConfigDefinitions();

        $this->assertArrayHasKey('affiliateCampaignId', $d);
        $this->assertEquals([
            'valid' => ['string']
        ], $d['affiliateCampaignId']);

        $this->assertArrayHasKey('affiliateReferenceId', $d);
        $this->assertEquals([
            'valid' => ['string']
        ], $d['affiliateReferenceId']);

        $this->assertArrayHasKey('apiVersion', $d);
        $this->assertEquals([
            'valid' => ['string'],
            'default' => BrowseService::API_VERSION,
            'required' => true
        ], $d['apiVersion']);

        $this->assertArrayHasKey('authorization', $d);
        $this->assertEquals([
            'valid'   => ['string'],
            'required' => true
        ], $d['authorization']);

        $this->assertArrayHasKey('contextualLocation', $d);
        $this->assertEquals([
            'valid' => ['string']
        ], $d['contextualLocation']);

        $this->assertArrayHasKey('marketplaceId', $d);
        $this->assertEquals([
            'valid' => ['string']
        ], $d['marketplaceId']);
    }

    public function testRequiredEbayHeaders()
    {
        $h = new HttpRestHandler();

        $s = new Service([
            'authorization' => '321',
            'httpHandler' => $h
        ]);

        $s->testOperation();

        // Test required headers first.
        $this->assertArrayHasKey(BrowseBaseService::HDR_AUTHORIZATION, $h->headers);
        $this->assertEquals('Bearer 321', $h->headers[BrowseBaseService::HDR_AUTHORIZATION]);

        // Test that optional headers have not been set until they have been configured.
        $this->assertArrayNotHasKey(BrowseBaseService::HDR_MARKETPLACE_ID, $h->headers);
        $this->assertArrayNotHasKey(BrowseBaseService::HDR_END_USER_CTX, $h->headers);
    }

    public function testOptionalEbayHeaders()
    {
        $h = new HttpRestHandler();

        $s = new Service([
            'authorization' => '321',
            'affiliateCampaignId' => 'foo',
            'affiliateReferenceId' => 'bar',
            'contextualLocation' => 'baz',
            'marketplaceId' => '123',
            'httpHandler' => $h
        ]);

        $s->testOperation();

        $this->assertArrayHasKey(BrowseBaseService::HDR_MARKETPLACE_ID, $h->headers);
        $this->assertEquals('123', $h->headers[BrowseBaseService::HDR_MARKETPLACE_ID]);
        $this->assertEquals('affiliateCampaignId=foo,affiliateReferenceId=bar,contextualLocation=baz', $h->headers[BrowseBaseService::HDR_END_USER_CTX ]);
    }
}
