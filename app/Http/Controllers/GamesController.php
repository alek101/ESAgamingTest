<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game as ModelsGame;


class GamesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $games=ModelsGame::all();
        return view('games',['games'=>$games]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newGame=new ModelsGame();
        $newGame->saveOrFail();
        return redirect()->back();
    }
    
    
    
}
