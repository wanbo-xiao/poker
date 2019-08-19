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
        $straight = $this->service->isCardStraight($cards);
        return view('home',['cards'=>$cards,'straight'=>$straight]);
    }
}
