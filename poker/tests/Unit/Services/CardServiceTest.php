<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Services\CardService;

class CardServiceTest extends TestCase
{
    protected $service;
    public function setUp(): void
    {
        parent::setUp();
        $this->service = new CardService();
    }

    public function tearDown(): void
    {
        parent::tearDown();
    }
    
    public function testDrawCards()
    {
        $cardSuites = array('s', 'h', 'c', 'd');
        $cardRank = range(2, 10);
        $cardRank = array_merge($cardRank, array('a', 'j', 'q', 'k'));
        $result = $this->service->drawCards();
        $this->assertInternalType('array', $result);
        $this->assertCount(5, $result);
        $this->assertCount(5, array_unique($result));
        foreach ($result as $val) {
            $this->assertInternalType('string', $val);
            $this->assertGreaterThanOrEqual(2, strlen($val));
            $this->assertLessThanOrEqual(3, strlen($val));
            $chars = str_split($val);
            if (strlen($val) == 3) {
                $this->assertStringStartsWith('10', $val);
                $this->assertContains($chars[2], $cardSuites);
            } else {
                $this->assertContains($chars[0], $cardRank);
                $this->assertContains($chars[1], $cardSuites);
            }
        }
    }
    public function testIsCardStraight()
    {
        $this->assertTrue($this->service->isCardStraight(array('2h', '4h', '3h', 'ah', '5h')));
        $this->assertTrue($this->service->isCardStraight(array('8h', 'jc', 'qc', '10d', '9s')));
        $this->assertTrue($this->service->isCardStraight(array('ah', '10d', 'qh', 'jc', 'kd')));
        $this->assertTrue($this->service->isCardStraight(array('7h', '5s', '4s', '8d', '6h')));
        $this->assertFalse($this->service->isCardStraight(array('3h', 'js', '3h', '5d', '4h')));
        $this->assertFalse($this->service->isCardStraight(array('2h', '2s', '3h', '4d', '6h')));
        $this->assertFalse($this->service->isCardStraight(array('js', 'as', 'ks', '2s', 'qs')));
    }

    public function testIsCardFlush() {
        $this->assertTrue($this->service->isCardFlush(array('2h', '4h', '9h', 'ah', '5h')));
        $this->assertFalse($this->service->isCardFlush(array('2h', '4h', '9h', 'as', '5h')));
    }

    public function testIsCardStraightFlush() {
        $this->assertTrue($this->service->isCardStraightFlush(array('2h', '4h', '3h', 'ah', '5h')));
        $this->assertFalse($this->service->isCardStraightFlush(array('2h', '4s', '3h', 'ah', '5h')));
        $this->assertFalse($this->service->isCardStraightFlush(array('2h', '9h', '3h', 'ah', '5h')));
    }

    public function testIsCardFourKind(){
        $this->assertTrue($this->service->isCardFourKind(array('2h', '2s', '2c', '2d', '5h')));
        $this->assertFalse($this->service->isCardFourKind(array('2h', '5s', '2c', '2d', '5h')));
    }

    public function testIsCardFullHouse(){
        $this->assertTrue($this->service->isCardFullHouse(array('2h', '5s', '2c', '2d', '5h')));
        $this->assertFalse($this->service->isCardFullHouse(array('2h', '2s', '2c', '2d', '5h')));
        $this->assertFalse($this->service->isCardFullHouse(array('2h', '6s', '2c', '2d', '5h')));
    }

    public function testIsCardThreeKind(){
        $this->assertTrue($this->service->isCardThreeKind(array('2h', '6s', '2c', '2d', '5h')));
        $this->assertFalse($this->service->isCardThreeKind(array('2h', '5s', '2c', '2d', '5h')));
        $this->assertFalse($this->service->isCardThreeKind(array('2h', '2s', '2c', '2d', '5h')));
        $this->assertFalse($this->service->isCardThreeKind(array('2h', '2s', '6c', '5d', '5h')));
    }

    public function testIsCardTwoPairs(){
        $this->assertTrue($this->service->isCardTwoPairs(array('2h', '2s', '6c', '5d', '5h')));
        $this->assertFalse($this->service->isCardTwoPairs(array('2h', '6s', '2c', 'ad', '5h')));
        $this->assertFalse($this->service->isCardTwoPairs(array('2h', '6s', '2c', '2d', '5h')));
        $this->assertFalse($this->service->isCardTwoPairs(array('2h', '5s', '2c', '2d', '5h')));
        $this->assertFalse($this->service->isCardTwoPairs(array('2h', '2s', '2c', '2d', '5h')));
    }

    public function testIsCardOnePair(){
        $this->assertTrue($this->service->isCardOnePair(array('2h', '2s', '6c', 'jd', '5h')));
        $this->assertFalse($this->service->isCardOnePair(array('2h', '2s', '6c', '5d', '5h')));
        $this->assertFalse($this->service->isCardOnePair(array('2h', '6s', '2c', '2d', '5h')));
        $this->assertFalse($this->service->isCardOnePair(array('2h', '5s', '2c', '2d', '5h')));
        $this->assertFalse($this->service->isCardOnePair(array('2h', '2s', '2c', '2d', '5h')));
    }
}
