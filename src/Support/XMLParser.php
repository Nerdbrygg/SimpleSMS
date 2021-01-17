<?php

namespace Nerdbrygg\SimpleSMS\Support;

use SimpleXMLElement;

class XMLParser
{
    public static function parse(array $xmlData)
    {
        $xmlElement = new SimpleXMLElement('<' . array_keys($xmlData)[0] . '/>');

        return (new static)->xmlFromArray($xmlData[array_keys($xmlData)[0]], $xmlElement);
    }

    protected function xmlFromArray(array $xmlData, SimpleXMLElement $xmlElement)
    {
        foreach ($xmlData as $node => $value) {
            if (is_array($value)) {
                if (is_numeric($node)) {
                    $node = 'msg';
                }
                $newNode = $xmlElement->addChild($node);
                $this->xmlFromArray($value, $newNode);
            } else {
                $xmlElement->addChild($node, $value);
            }
        }

        return $xmlElement->asXML();
    }
}
