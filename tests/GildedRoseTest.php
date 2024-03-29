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
    //Checks Once the sell by date has passed, Quality degrades twice as fast
    public function testQualityAllItemsAfterSellInPassed(): void
    {
        $items = [new Item('Elixir of the Mongoose', -2, 20)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals($items[0]->quality, 18);
        $this->assertEquals($items[0]->sellIn, -3); 
    } 
    //Checks that the value has not been updated to negative
    public function testQualityOfAllItemsNotNegative(): void
    {
        $items = [new Item('Elixir of the Mongoose', 6, 0)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals($items[0]->quality, 0); 
        $this->assertEquals($items[0]->sellIn, 5); 
    } 
    //"Aged Brie" tests actually increase by 1 in quality as it ages before its sellIn has passed
    public function testAgedBrieQuality(): void
    {
       $items = [new Item('Aged Brie', 6, 30)];
       $gildedRose = new GildedRose($items);
       $gildedRose->updateQuality();
       $this->assertEquals($items[0]->quality, 31); 
       $this->assertEquals($items[0]->sellIn, 5);
    }
    //"Aged Brie" tests actually increase by 2 in quality as it ages after its sellIn has passed
    public function testAgedBrieQualityAfterSellInPassed(): void
    {
        $items = [new Item('Aged Brie', -2, 30)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals($items[0]->quality, 32);
        $this->assertEquals($items[0]->sellIn, -3); 
    } 
    //Checks 'Aged Brie' that the quality value has not been updated more than 50
    public function testAgedBrieQualityNotMore50(): void
    {
        $items = [new Item('Aged Brie', 10, 50)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals($items[0]->quality, 50); 
        $this->assertEquals($items[0]->sellIn, 9); 
    } 
    //'Backstage passes to a TAFKAL80ETC concert' tests actually increase by 1 in quality which sellIn greater than 10
    public function testBackstageQuality(): void
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 12, 30)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals($items[0]->quality, 31); 
        $this->assertEquals($items[0]->sellIn, 11); 
    } 
    //'Backstage passes to a TAFKAL80ETC concert' tests actually increase by 2 in quality which sellIn smaller than 11
    public function testBackstageQualityWhenSellInSmaller11(): void
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 10, 30)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals($items[0]->quality, 32); 
        $this->assertEquals($items[0]->sellIn, 9); 
    } 
    //'Backstage passes to a TAFKAL80ETC concert' tests actually increase by 3 in quality which sellIn smaller than 6
    public function testBackstageQualityWhenSellInSmaller6(): void
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 5, 30)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals($items[0]->quality, 33); 
        $this->assertEquals($items[0]->sellIn, 4); 
    } 
    //'Backstage passes to a TAFKAL80ETC concert' tests Quality drops to 0 when the concert
    public function testBackstageQualityWhenTheConcert(): void
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 0, 10)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals($items[0]->quality, 0); 
        $this->assertEquals($items[0]->sellIn, -1);
    }
    //'Backstage passes to a TAFKAL80ETC concert' tests Quality not increase after the concert
    public function testBackstageQualityAfterTheConcert(): void
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', -1, 0)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals($items[0]->quality, 0); 
        $this->assertEquals($items[0]->sellIn, -2); 
    }   
    //'Backstage passes to a TAFKAL80ETC concert' tests that the quality value has not been updated more than 50
    public function testBackstageQualityNotMore50(): void
    {
        $items = [new Item('Aged Brie', 4, 49)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals($items[0]->quality, 50); 
        $this->assertEquals($items[0]->sellIn, 3); 
    } 

    //Checks 'Sulfuras, Hand of Ragnaros' Quality equals 80
    public function testSulfurasQuality(): void
    {
        $items = [new Item('Sulfuras, Hand of Ragnaros', 0, 80)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals($items[0]->quality, 80);
        $this->assertEquals($items[0]->sellIn, 0); 
    } 
    //Checks 'Sulfuras, Hand of Ragnaros' SellIn does not change
    public function testSulfurasSellIn(): void
    {
        $items = [new Item('Sulfuras, Hand of Ragnaros', 10, 80)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals($items[0]->quality, 80);
        $this->assertEquals($items[0]->sellIn, 10);
    }
    //checks 'Conjured Mana Cake' before sellIn has passed
    public function testConjuredBeforeSellInPassed(): void
    {
        $items = [new Item('Conjured Mana Cake', 10, 20)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals($items[0]->quality, 18);
        $this->assertEquals($items[0]->sellIn, 9);
    }
    //checks 'Conjured Mana Cake' after sellIn has passed
    public function testConjuredSellInPassed(): void
    {
        $items = [new Item('Conjured Mana Cake', 0, 20)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals($items[0]->quality, 16);
        $this->assertEquals($items[0]->sellIn, -1);
    }
}
