<?php

declare(strict_types=1);

namespace GildedRose;

interface IUpdateItems
{
    public function updateQuality(Item $item): void;
}