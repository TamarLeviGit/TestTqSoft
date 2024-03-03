<?php

declare(strict_types=1);

namespace GildedRose;

class UpdateBackstagePassesItem implements IUpdateItems
{
    public function updateQuality(Item $item): void{
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
}