<?php
namespace App\Services;

class CardService
{
    public function drawCards()
    {
        $cardSuites = array('s', 'h', 'c', 'd');
        $cardSpecialRank = array(0 => 'k', 1 => 'a', 11 => 'j', 12 => 'q');
        $cards = range(0, 51);
        shuffle($cards);
        $cardSets = array();
        for ($i = 0; $i < 5; $i++) {
            $drawCard = $cards[$i];
            $suit = $drawCard / 13;
            $rank = $drawCard % 13;
            $cardSets[] = (array_key_exists($rank, $cardSpecialRank) ? $cardSpecialRank[$rank] : $rank) . $cardSuites[$suit];
        }
        return $cardSets;
    }
    // 121 character
    public function isCardStraight($b)
    {
        $t = 0;
        foreach ($b as $s) {
            $t |= (1 << (int) strtr($s, ['a' => 1, 'j' => 11, 'q' => 12, 'k' => 13]));
        }
        return $t == 15362 || strstr(decbin($t), '11111');
    }
    // 143 character
    public function isCardStraight_1($b)
    {
        foreach ($b as &$s) {
            $s = (int) strtr($s, ['a' => 1, 'j' => 11, 'q' => 12, 'k' => 13]);
        }
        sort($b);
        return count(array_flip($b)) > 4 && ($b[4] - $b[0] < 5 || $b[1] - $b[0] == 9);
    }

    public function isCardFlush($cards){
        $suits = [];
        foreach ($cards as $suit) {
            $suits[] = substr($suit,-1,1);
        }
        return (count(array_unique($suits)) == 1);
    }

    public function isCardStraightFlush($cards){
        return $this->isCardFlush($cards) && $this->isCardStraight($cards);
    }

    public function isCardFourKind($cards){
        $numbers = [];
        foreach ($cards as $suit) {
            $numbers[] = substr($suit,0,1);
        }
        $countNumbers = array_count_values($numbers);
        sort($countNumbers);
        return (count($countNumbers) == 2 && $countNumbers[0] == 1);
    }

    public function isCardFullHouse($cards){
        $numbers = [];
        foreach ($cards as $suit) {
            $numbers[] = substr($suit,0,1);
        }
        $countNumbers = array_count_values($numbers);
        sort($countNumbers);
        return (count($countNumbers) == 2 && $countNumbers[0] == 2);
    }

    public function isCardThreeKind($cards){
        $numbers = [];
        foreach ($cards as $suit) {
            $numbers[] = substr($suit,0,1);
        }
        $countNumbers = array_count_values($numbers);
        sort($countNumbers);
        return (count($countNumbers) == 3 && $countNumbers[2] == 3);
    }

    public function isCardTwoPairs($cards){
        $numbers = [];
        foreach ($cards as $suit) {
            $numbers[] = substr($suit,0,1);
        }
        $countNumbers = array_count_values($numbers);
        sort($countNumbers);
        return (count($countNumbers) == 3 && $countNumbers[2] == 2);
    }

    public function isCardOnePair($cards){
        $numbers = [];
        foreach ($cards as $suit) {
            $numbers[] = substr($suit,0,1);
        }
        $countNumbers = array_unique($numbers);
        return (count($countNumbers) == 4) ;
    }
}
