<?php

namespace Nerdbrygg\SimpleSMS\Support;

use DOMDocument;
use SimpleXMLElement;

class XMLParser
{
    public static function parse(array $xmlData)
    {
        return (new static)->handle($xmlData);
    }

    public function handle(array $xmlData)
    {
        $xmlElement = new SimpleXMLElement('<' . strtoupper(array_keys($xmlData)[0]) . '/>');

        $xmlDocument = $this->xmlFromArray($xmlData[array_keys($xmlData)[0]], $xmlElement);

        return $this->xmlFormat($xmlDocument);
    }

    protected function xmlFromArray(array $xmlData, SimpleXMLElement $xmlElement)
    {
        foreach ($xmlData as $node => $value) {
            if (is_array($value)) {
                if (is_numeric($node)) {
                    $node = 'MSG';
                }
                $newNode = $xmlElement->addChild(strtoupper($node));
                $this->xmlFromArray($value, $newNode);
            } else {
                $xmlElement->addChild(strtoupper($node), $value);
            }
        }

        return $xmlElement->asXML();
    }

    protected function xmlFormat($xml)
    {
        $xmlDOM = new DOMDocument();
        $xmlDOM->preserveWhiteSpace = false;
        $xmlDOM->formatOutput = true;
        $xmlDOM->encoding = "UTF-8";
        $xmlDOM->loadXML($xml);

        return $xmlDOM->saveXML();
    }
}
