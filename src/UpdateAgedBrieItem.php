<?php

declare(strict_types=1);

namespace GildedRose;

class UpdateAgedBrieItem implements IUpdateItems
{
    public static function updateQuality(Item $item): void{
        $item->sellIn = $item->sellIn - 1;
        if ($item->sellIn < 0) {
            $item->quality = $item->quality + 1;
        }
        $item->quality = $item->quality + 1;
        if ($item->quality > 50) {
            $item->quality = 50;
        }
    }
}
