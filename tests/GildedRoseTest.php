<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\GildedRose;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
    // public function testFoo(): void
    // {
    //     $items = [new Item('foo', 0, 0)];
    //     $gildedRose = new GildedRose($items);
    //     $gildedRose->updateQuality();
    //     $this->assertSame('fixme', $items[0]->name);
    // }
    //Checks quality all simple items 
    public function testQualityOfAllItems(): void
    {
        $items = [new Item('+5 Dexterity Vest', 3, 5)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals($items[0]->quality, 4); 
        $this->assertEquals($items[0]->sellIn, 2); 
    } 
    //Checks that the value has not been updated to negative
    public function testQualityOfAllItemsNotNegative(): void
    {
        $items = [new Item('QualityNotNegative', 0, 0)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals($items[0]->quality, 0); 
    } 
    //Checks 'Aged Brie' and 'Backstage passes to a TAFKAL80ETC concert' items that the quality value has not been updated more than 50 except for 'Sulfuras, Hand of Ragnaros'
    public function testAgedBrieQualityNotMore_50(): void
    {
        $items1 = [new Item('Aged Brie', 10, 50)];
        $items2 = [new Item('Backstage passes to a TAFKAL80ETC concert', 5, 48)];
        $gildedRose = new GildedRose($items1, $items2);
        $gildedRose->updateQuality();
        $this->assertEquals($items[0]->quality, 50); 
        $this->assertEquals($items[1]->quality, 50); 
    } 
    //"Aged Brie" tests actually increase by 1 in quality as it ages before its sellIn has passed
    public function testAgedBrieQualityBeforeSellInPassed(): void
    {
        $items = [new Item('Aged Brie', 2, 30)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals($items[0]->quality, 31); 
    } 
    //"Aged Brie" tests actually increase by 2 in quality as it ages after its sellIn has passed
    public function testAgedBrieQualityAfterSellInPassed(): void
    {
        $items = [new Item('Aged Brie', -2, 30)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals($items[0]->quality, 32); 
    } 
    //'Backstage passes to a TAFKAL80ETC concert' tests actually increase by 1 in quality which sellIn greater than 10
    public function testBackstageQualityWhenSellInGreater10(): void
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 12, 30)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals($items[0]->quality, 31); 
    } 
    //'Backstage passes to a TAFKAL80ETC concert' tests actually increase by 2 in quality which sellIn smaller than 11
    public function testBackstageQualityWhenSellInSmaller11(): void
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 10, 30)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals($items[0]->quality, 32); 
    } 
    //'Backstage passes to a TAFKAL80ETC concert' tests actually increase by 3 in quality which sellIn smaller than 6
    public function testBackstageQualityWhenSellInSmaller6(): void
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 5, 30)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals($items[0]->quality, 33); 
    } 
    //'Backstage passes to a TAFKAL80ETC concert' tests Quality drops to 0 after the concert
    public function testBackstageQualityAfterTheConcert(): void
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 1, 30)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals($items[0]->quality, 0); 
    } 
    //Checks Once the sell by date has passed, Quality degrades twice as fast
    public function testQualityOfAllItemsAfterSellInPassed(): void
    {
        $items = [new Item('simpleItems', -1, 10)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals($items[0]->quality, 8); 
    } 
    //Checks 'Sulfuras, Hand of Ragnaros' Quality equals 80
    public function testSulfurasQuality(): void
    {
        $items = [new Item('Sulfuras, Hand of Ragnaros', 0, 80)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals($items[0]->quality, 80); 
    } 
    //Checks 'Sulfuras, Hand of Ragnaros' SellIn does not change
    public function testSulfurasSellIn(): void
    {
        $items = [new Item('Sulfuras, Hand of Ragnaros', 10, 80)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals($items[0]->sellIn, 10); 
    }




   
}
