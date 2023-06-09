<?php

namespace App;

class GildedRose
{
    public $name;

    public $quality;

    public $sellIn;

    public function __construct($name, $quality, $sellIn)
    {
        $this->name = $name;
        $this->quality = $quality;
        $this->sellIn = $sellIn;
    }

    public static function of($name, $quality, $sellIn)
    {
        return new static($name, $quality, $sellIn);
    }

    public function updateConjured()
    {
        if ($this->quality > 0) {

            if ($this->sellIn > 0) {
                $this->quality = $this->quality - 2;
            } else {
                $this->quality = $this->quality - 4;
            }
        } else {
            $this->quality = 0;
        }
    }


    public function updateOther()
    {
        if ($this->quality > 0) {
            $this->quality = $this->quality - 1;
        }
    }

    public function updateAgeBrie()
    {
        if ($this->quality < 50) {
            $this->quality = $this->quality + 1;
        }
    }


    public function updateBackstage()
    {
        if ($this->quality < 50) {
            $this->quality = $this->quality + 1;
        }

        if ($this->sellIn < 11) {
            if ($this->quality < 50) {
                $this->quality = $this->quality + 1;
            }
        }
        if ($this->sellIn < 6) {
            if ($this->quality < 50) {
                $this->quality = $this->quality + 1;
            }
        }
    }


    public function degradarSellIn()
    {
        if ($this->sellIn < 0) {
            if ($this->name != 'Aged Brie') {
                if ($this->name != 'Backstage passes to a TAFKAL80ETC concert') {
                    if ($this->quality > 0) {
                        if ($this->name != 'Sulfuras, Hand of Ragnaros') {
                            $this->quality = $this->quality - 1;
                        }
                    }
                } else {
                    $this->quality = $this->quality - $this->quality;
                }
            } else {
                if ($this->quality < 50) {
                    $this->quality = $this->quality + 1;
                }
            }
        }
    }



    public function tick()
    {
        switch ($this->name) {
            case 'Conjured':
                $this->updateConjured();
                break;

            case 'Aged Brie':
                $this->updateAgeBrie();
                break;

            case 'Backstage passes to a TAFKAL80ETC concert':
                $this->updateBackstage();
                break;

            default:
                $this->updateOther();
                break;
        }

 
        if ($this->name != 'Sulfuras, Hand of Ragnaros') {
            $this->sellIn = $this->sellIn - 1;
        }

        if ($this->sellIn < 0) {
            $this->degradarSellIn();
        }
    }
}
