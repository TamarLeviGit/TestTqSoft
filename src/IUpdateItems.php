<?php

declare(strict_types=1);

namespace GildedRose;

interface IUpdateItems
{
    public static function updateQuality(Item $item): void;
}