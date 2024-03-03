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
                if ($item->name != 'Aged Brie' and $item->name != 'Backstage passes to a TAFKAL80ETC concert') {
                    if ($item->quality > 0) {
                        $item->quality = $item->quality - 1;     
                    }
                } 
                else {
                    if ($item->quality < 50) {
                        $item->quality = $item->quality + 1;
                        if ($item->name == 'Backstage passes to a TAFKAL80ETC concert') {
                            if ($item->sellIn < 6) {
                                $item->quality = $item->quality + 2;
                            }
                            elseif ($item->sellIn < 11) {
                                $item->quality = $item->quality + 1;
                            }
                            if ($item->quality > 50) {
                                $item->quality = 50;
                            }
                        }
                    }
                }
                $item->sellIn = $item->sellIn - 1;
                if ($item->sellIn < 0) {
                    if ($item->name != 'Aged Brie') {
                        if ($item->name != 'Backstage passes to a TAFKAL80ETC concert') {
                            if ($item->quality > 0) {
                                $item->quality = $item->quality - 1;
                            }
                        } else {
                            $item->quality = $item->quality - $item->quality;
                        }
                    } else {
                        if ($item->quality < 50) {
                            $item->quality = $item->quality + 1;
                        }
                    }
                }  
            }
        }
    }
}
