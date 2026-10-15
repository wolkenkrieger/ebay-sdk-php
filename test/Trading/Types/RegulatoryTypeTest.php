<?php

namespace DTS\eBaySDK\Test\Trading\Types;

use DTS\eBaySDK\Trading\Types\RegulatoryType;

class RegulatoryTypeTest extends \PHPUnit_Framework_TestCase
{
    private $obj;

    protected function setUp()
    {
        $this->obj = new RegulatoryType();
    }

    public function testCanBeCreated()
    {
        $this->assertInstanceOf('\DTS\eBaySDK\Trading\Types\RegulatoryType', $this->obj);
    }

    public function testExtendsBaseType()
    {
        $this->assertInstanceOf('\DTS\eBaySDK\Types\BaseType', $this->obj);
    }

    public function testProductSafetyIsSerializedToRequestXml()
    {
        $item = new \DTS\eBaySDK\Trading\Types\ItemType([
            'Regulatory' => new RegulatoryType([
                'ProductSafety' => new \DTS\eBaySDK\Trading\Types\ProductSafetyType([
                    'Pictograms' => new \DTS\eBaySDK\Trading\Types\PictogramsType(['Pictogram' => ['P1', 'P2']]),
                    'Statements' => new \DTS\eBaySDK\Trading\Types\StatementsType(['Statement' => ['S1']]),
                    'Component'  => 'Tipping hazard'
                ])
            ])
        ]);

        $request = new \DTS\eBaySDK\Trading\Types\VerifyAddFixedPriceItemRequestType(['Item' => $item]);

        $xml = $request->toRequestXml();

        $this->assertContains('<Regulatory', $xml);
        $this->assertContains('<Component>Tipping hazard</Component>', $xml);
        $this->assertContains('<Pictogram>P1</Pictogram>', $xml);
        $this->assertContains('<Pictogram>P2</Pictogram>', $xml);
        $this->assertContains('<Statement>S1</Statement>', $xml);
    }

    public function testHazmatManufacturerAndResponsiblePersonsAreSerializedToRequestXml()
    {
        $item = new \DTS\eBaySDK\Trading\Types\ItemType([
            'Regulatory' => new RegulatoryType([
                'Hazmat' => new \DTS\eBaySDK\Trading\Types\HazmatType([
                    'SignalWord' => 'Danger',
                    'Statements' => new \DTS\eBaySDK\Trading\Types\StatementsType(['Statement' => ['H1']])
                ]),
                'Manufacturer' => new \DTS\eBaySDK\Trading\Types\ManufacturerType([
                    'CompanyName' => 'ACME GmbH',
                    'Country' => 'DE'
                ]),
                'ResponsiblePersons' => new \DTS\eBaySDK\Trading\Types\ResponsiblePersonsType([
                    'ResponsiblePerson' => [
                        new \DTS\eBaySDK\Trading\Types\ResponsiblePersonType([
                            'CompanyName' => 'EU Rep BV',
                            'Types' => new \DTS\eBaySDK\Trading\Types\ResponsiblePersonCodeTypes([
                                'Type' => [\DTS\eBaySDK\Trading\Enums\ResponsiblePersonCodeType::C_EU_RESPONSIBLE_PERSON]
                            ])
                        ])
                    ]
                ])
            ])
        ]);

        $request = new \DTS\eBaySDK\Trading\Types\VerifyAddFixedPriceItemRequestType(['Item' => $item]);

        $xml = $request->toRequestXml();

        $this->assertContains('<SignalWord>Danger</SignalWord>', $xml);
        $this->assertContains('<CompanyName>ACME GmbH</CompanyName>', $xml);
        $this->assertContains('<Country>DE</Country>', $xml);
        $this->assertContains('<ResponsiblePerson', $xml);
        $this->assertContains('<Type>EUResponsiblePerson</Type>', $xml);
    }

    public function testDocumentsEnergyEfficiencyAndRepairScoreAreSerializedToRequestXml()
    {
        $item = new \DTS\eBaySDK\Trading\Types\ItemType([
            'Regulatory' => new RegulatoryType([
                'Documents' => new \DTS\eBaySDK\Trading\Types\DocumentsType([
                    'Document' => [
                        new \DTS\eBaySDK\Trading\Types\DocumentType(['DocumentID' => 'DOC1']),
                        new \DTS\eBaySDK\Trading\Types\DocumentType(['DocumentID' => 'DOC2'])
                    ]
                ]),
                'EnergyEfficiencyLabel' => new \DTS\eBaySDK\Trading\Types\EnergyEfficiencyType([
                    'ImageURL' => 'https://i.ebayimg.com/label.jpg',
                    'ImageDescription' => 'On a scale of A to G the rating is E',
                    'ProductInformationsheet' => 'https://i.ebayimg.com/sheet.pdf'
                ]),
                'RepairScore' => 7.9
            ])
        ]);

        $request = new \DTS\eBaySDK\Trading\Types\VerifyAddFixedPriceItemRequestType(['Item' => $item]);

        $xml = $request->toRequestXml();

        $this->assertContains('<DocumentID>DOC1</DocumentID>', $xml);
        $this->assertContains('<DocumentID>DOC2</DocumentID>', $xml);
        $this->assertContains('<ImageURL>https://i.ebayimg.com/label.jpg</ImageURL>', $xml);
        $this->assertContains('<ProductInformationsheet>https://i.ebayimg.com/sheet.pdf</ProductInformationsheet>', $xml);
        $this->assertContains('<RepairScore>7.9</RepairScore>', $xml);
    }
}
