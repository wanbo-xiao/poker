<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CardService;

class HomeController extends Controller
{
    protected $service;

    public function __construct(CardService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $cards = $this->service->drawCards();
        $msg = "They are nothing";

        if ($this->service->isCardStraightFlush($cards)) {
            $msg = "They are Straight Flush";
        } elseif ($this->service->isCardFourKind($cards)) {
            $msg = "They are Four of a Kind";
        } elseif ($this->service->isCardFullHouse($cards)) {
            $msg = "They are Full House";
        } elseif ($this->service->isCardFlush($cards)) {
            $msg = "They are Flush";
        } elseif ($this->service->isCardStraight($cards)) {
            $msg = "They are Straight";
        } elseif ($this->service->isCardThreeKind($cards)) {
            $msg = "They are Three of a Kind";
        } elseif ($this->service->isCardTwoPairs($cards)) {
            $msg = "They are Two Pair";
        } elseif ($this->service->isCardOnePair($cards)) {
            $msg = "They are Pair";
        }
        return view('home', ['cards'=>$cards,'msg'=>$msg]);
    }
}
