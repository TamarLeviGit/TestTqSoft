<?php

declare(strict_types=1);

namespace GildedRose;

// require_once 'Item.php';
require_once 'UpdateAgedBrieItem.php';
require_once 'UpdateBackstagePassesItem.php';
require_once 'UpdateConjuredItem.php';
require_once 'UpdateDefaultItem.php';

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
            $this->updateItemsQuality($item);   
        }
    }
    private function updateItemsQuality(Item $item): void
    {
        switch ($item->name) {
            case 'Aged Brie':
                UpdateAgedBrieItem::updateQuality($item);
                break;
            case 'Backstage passes to a TAFKAL80ETC concert':
                UpdateBackstagePassesItem::updateQuality($item);
                break;
            case 'Conjured Mana Cake':
                UpdateConjuredItem::updateQuality($item);
                break;
            case 'Sulfuras, Hand of Ragnaros':
                break;
            default:
            UpdateDefaultItem::updateQuality($item);
        }
    }
}
