<?php

declare(strict_types=1);

namespace GildedRose;

final class GildedRose
{
    /**
     * @param Item[] $items
     */
    public function __construct(
        private array $items
    ) {
    }

    public function updateQuality(): void
    {
        foreach ($this->items as $item) {
            if ($item->name != 'Sulfuras, Hand of Ragnaros') { 
                $item->sellIn = $item->sellIn - 1;  
                if($item->name == 'Aged Brie'){
                    if ($item->sellIn < 0) {
                        $item->quality = $item->quality + 1;
                    }
                    $item->quality = $item->quality + 1;
                    if ($item->quality > 50) {
                        $item->quality = 50;
                    }
                }
                else if ($item->name == 'Backstage passes to a TAFKAL80ETC concert'){
                    if($item->sellIn < 0) {
                        $item->quality = 0;
                    }
                    else{
                        $item->quality = $item->quality + 1;
                        if ($item->sellIn < 5) {
                            $item->quality = $item->quality + 2;
                        }
                        else if ($item->sellIn < 10) {
                            $item->quality = $item->quality + 1;
                        }
                        if ($item->quality > 50) {
                            $item->quality = 50;
                        }
                    }
                }
                else{
                    if($item->sellIn < 0) {
                        $item->quality = $item->quality - 1;
                    } 
                    $item->quality = $item->quality - 1;
                    if($item->quality < 0){
                        $item->quality = 0;
                    }
                } 
            }
        }
    }
}
