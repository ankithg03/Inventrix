<?php

namespace Dhruvi\HelloWorld\Block;

use Magento\Framework\View\Element\Template;

class Helloworld extends Template
{
    public function getText() {
        //return "Hello World";
    $a=10;
    $b=5;
    $c=$a+$b;
    return $c;
    }
}