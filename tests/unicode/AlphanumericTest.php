<?php

namespace Valid\Test\Unicode;

require_once dirname(__FILE__) . '/../index.php';

use PHPUnit\Framework\TestCase;
use Valid\Unicode\Alphanumeric;

class AlphanumericTest extends TestCase {
  public function setup() {
    $this->alphanumeric = new Alphanumeric;
    $this->testSet = array(
      // Latin
      array(
        'original' => '=== 123 \'The\' (Quick Brown Fox) [Jumps Over] The /Lazy/ "Dog" 456 ===',
        'expected' => '123-the-quick-brown-fox-jumps-over-the-lazy-dog-456',
        'message' => 'Latin character filtering',
      ),
      array(
        'original' => '=== 123 \'The\' (Quick Brown Fox) [Jumps Over] 
        The /Lazy/ "Dog" 456 ===',
        'expected' => '123-the-quick-brown-fox-jumps-over-the-lazy-dog-456',
        'message' => 'Latin character filtering with line break',
      ),
      array(
        'original' => '
        === 123 \'The\' (Quick Brown Fox) '. "\r" . "\n". '[Jumps Over] 
        The /Lazy/ "Dog" 456 ===
        ',
        'expected' => '123-the-quick-brown-fox-jumps-over-the-lazy-dog-456',
        'message' => 'Latin character filtering with line break by the end',
      ),

      // Chinese char
      array(
        'original' => '123 敏捷（的棕色狐狸）跳过了【懒狗】 456',
        'expected' => '123-敏捷-的棕色狐狸-跳过了-懒狗-456',
        'message' => 'Chinese character filtering',
      ),

      // Cyrillic
      array(
        'original' => '=== Лорем ипсум долор [сит] амет, еи {хабемус} пхаедрум ехпетенда мел ===',
        'expected' => 'лорем-ипсум-долор-сит-амет-еи-хабемус-пхаедрум-ехпетенда-мел',
        'message' => 'Cyrillic character filtering',
      ),

      // Arabic
      array(
        'original' => '123 (كويك براون فوكس) [القفز فوق] و / كسول / الكلب 456',
        'expected' => '123-كويك-براون-فوكس-القفز-فوق-و-كسول-الكلب-456',
        'message' => 'Arabic character filtering',
      ),

      // Thai
      array(
        'original' => '123 สุนัขจิ้งจอกสีบลอนด์กระโดดข้ามหมาขี้เกียจ 456',
        'expected' => '123-สุนัขจิ้งจอกสีบลอนด์กระโดดข้ามหมาขี้เกียจ-456',
        'message' => 'Thai character filtering',
      ),
    );
  }

  public function testMBReplacement() {
    foreach($this->testSet as $lang => $set) {
      $output = $this->alphanumeric->createUrlFragmentMB($set['original']);
      $this->assertEquals($output, $set['expected'], $set['message']);
    }
  }
}
