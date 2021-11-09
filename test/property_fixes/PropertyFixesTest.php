<?php
namespace DTS\eBaySDK\Types\Test;

use DTS\eBaySDK as Sdk;
/**
 * These tests are to cover where we have corrected
 * the property names of various classes.
 * These names have been incorrectly named in the documentation.
 * The names used for the properties are now taken from the actual response from the API.
 */
class PropertyFixesTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Incorrect documentation https://developer.ebay.com/Devzone/post-order/types/CancelSummary.html
     * Example of correct property names returned in the API https://developer.ebay.com/Devzone/post-order/post-order_v2_cancellation_search__get.html#Output
     * Example of correct property names returned in the API https://github.com/davidtsadler/ebay-sdk-php/issues/108
     */
    public function testCancelSummary()
    {
        $obj = new Sdk\PostOrder\Types\CancelSummary();

        $this->assertEquals(null, $obj->cancelState);
        $this->assertEquals(null, $obj->cancelStatus);
        $this->assertInstanceOf('\DTS\eBaySDK\Types\RepeatableType', $obj->lineItems);
    }

    /**
     * Incorrect documentation https://developer.ebay.com/Devzone/post-order/types/ItemEligibilityResult.html
     * Example of correct property names returned in the API https://developer.ebay.com/Devzone/post-order/post-order_v2_cancellation__post.html#Samples
     */
    public function testItemEligibilityResult()
    {
        $obj = new Sdk\PostOrder\Types\ItemEligibilityResult();

        $obj->itemId = '123';
        $this->assertInternalType('string', $obj->itemId);

        $obj->transactionId = '123';
        $this->assertInternalType('string', $obj->transactionId);
    }

    /**
     * Incorrect documentation https://developer.ebay.com/Devzone/post-order/ErrorResponse.html#ErrorResponse
     * Example of correct property names returned in the API https://github.com/davidtsadler/ebay-sdk-php/issues/105
     */
    public function testError()
    {
        $obj = new Sdk\PostOrder\Types\Error();

        $obj->subdomain = '123';
        $this->assertInternalType('string', $obj->subdomain);

        $obj->errorName = '123';
        $this->assertInternalType('string', $obj->errorName);

        $obj->resolution = '123';
        $this->assertInternalType('string', $obj->resolution);

        $obj->organization = '123';
        $this->assertInternalType('string', $obj->organization);

        $obj->errorGroups = '123';
        $this->assertInternalType('string', $obj->errorGroups);
    }

    public function testDeliveryCost()
    {
        $obj = new Sdk\Fulfillment\Types\DeliveryCost();

        $obj->discountAmount = new Sdk\Fulfillment\Types\Amount();
        $this->assertInstanceOf('\DTS\eBaySDK\Fulfillment\Types\Amount', $obj->discountAmount);
    }

    /**
     * Incorrect documentation https://developer.ebay.com/devzone/rest/api-ref/fulfillment/types/ShippingFulfillment.html
     * Example of correct property names returned in the API https://developer.ebay.com/devzone/rest/api-ref/fulfillment/order-orderid_shipping_fulfillment__get.html#Samples
     */
    public function testShippingServiceCode()
    {
        $obj = new Sdk\Fulfillment\Types\ShippingFulfillment();

        $obj->shippingServiceCode = 'foo';
        $this->assertInternalType('string', $obj->shippingServiceCode);
    }

    /**
     * Incorrect documentation https://developer.ebay.com/devzone/rest/api-ref/fulfillment/types/PricingSummary.html
     * Issue discussed at https://groups.google.com/forum/?hl=en-GB#!topic/ebay-sdk-php/Pz1s0K5V9ZE
     * Replace priceDiscountSubtotal with priceDiscount.
     */
    public function testPriceDiscount()
    {
        $obj = new Sdk\Fulfillment\Types\PricingSummary();

        $obj->priceDiscount = new Sdk\Fulfillment\Types\Amount();
        $this->assertInstanceOf('\DTS\eBaySDK\Fulfillment\Types\Amount', $obj->priceDiscount);
    }

    public function testPriceDiscountSubtotalDoesNotExist()
    {
        $this->setExpectedException('\DTS\eBaySDK\Exceptions\UnknownPropertyException', 'Unknown property');

        $obj = new Sdk\Fulfillment\Types\PricingSummary();

        $obj->priceDiscountSubtotal = new Sdk\Fulfillment\Types\Amount();
    }

    /**
     * Incorrect documentation https://developer.ebay.com/Devzone/post-order/types/CancelDetail.html
     * Example of correct property names returned in the API https://github.com/davidtsadler/ebay-sdk-php/issues/107
     */
    public function testCancelDetail()
    {
        $obj = new Sdk\PostOrder\Types\CancelDetail();

        $this->assertEquals(null, $obj->cancelState);
        $this->assertEquals(null, $obj->cancelStatus);
    }

    /**
     * Incorrect documentation https://developer.ebay.com/Devzone/post-order/types/CancelActivityHistory.html
     * Example of correct property names returned in the API https://github.com/davidtsadler/ebay-sdk-php/issues/107
     */
    public function testCancelActivityHistory()
    {
        $obj = new Sdk\PostOrder\Types\CancelActivityHistory();

        $this->assertEquals(null, $obj->cancelStateFrom);
        $this->assertEquals(null, $obj->cancelStateTo);
        /** Yes this is because there is a typo in the actual response from the API! */
        $this->assertEquals(null, $obj->cancelStatetateTo);
    }

    /**
     * Incorrect documentation https://developer.ebay.com/Devzone/post-order/types/CancelSummary.html
     * Incorrect documentation https://developer.ebay.com/Devzone/post-order/types/OrderCancelLineItem.html
     * Example of correct property names returned in the API https://github.com/davidtsadler/ebay-sdk-php/issues/108
     *
     * This is a bit of an odd one. CancelSummary::lineItems does not exist. Yet the API is returning it.
     * Adding this property means that is needs a lineItem class. Since I didn't want to create a new one
     * I've re-used OrderCancelLineItem.
     */
    public function testOrderCancelLineItem()
    {
        $obj = new Sdk\PostOrder\Types\OrderCancelLineItem();

        $obj->itemTitle = 'foo';
        $this->assertInternalType('string', $obj->itemTitle);

        $obj->cancelQuantity = 123;
        $this->assertInternalType('integer', $obj->cancelQuantity);
    }

    /**
     * Even though the documentation says that GalleryURL is not a member of PictureDetailsType
     * it is been returned in the API for various calls. E.g GetItem and GetMyeBaySelling.
     */
    public function testGalleryURL()
    {
        $obj = new Sdk\Trading\Types\PictureDetailsType();

        $obj->GalleryURL = 'foo';
        $this->assertInternalType('string', $obj->GalleryURL);
    }

    /**
     * Incorrect documentation https://developer.ebay.com/Devzone/post-order/types/UploadFileRequest.html
     * Issue: https://github.com/davidtsadler/ebay-sdk-php/issues/133
     * PR: https://github.com/davidtsadler/ebay-sdk-php/pull/134
     */
    public function testUploadFileRequest()
    {
        $obj = new Sdk\PostOrder\Types\UploadFileRequest();

        $obj->data = '';

        $this->assertInternalType('string', $obj->data);
    }

    /**
     * Even though the documentation does not say this exists
     * someone did raise it as an issue and you can pass it via the explorer.
     *
     * https://github.com/davidtsadler/ebay-sdk-php/issues/154
     */
    public function testVerifyOnly()
    {
        $obj = new Sdk\Trading\Types\ReviseFixedPriceItemRequestType();

        $obj->VerifyOnly = true;
        $this->assertInternalType('boolean', $obj->VerifyOnly);

        $obj = new Sdk\Trading\Types\ReviseFixedPriceItemResponseType();

        $obj->VerifyOnly = true;
        $this->assertInternalType('boolean', $obj->VerifyOnly);
    }


    /**
     * Code generation is not including this attribute
     * as the WSDL contains NoCalls.
     * In future we won't be using the WSDLs so this will
     * be less of an issue.
     */
    public function testProductIDTypeAttribute()
    {
        $obj = new Sdk\Shopping\Types\ProductIDType();

        $obj->type = '';

        $this->assertInternalType('string', $obj->type);
    }
}
