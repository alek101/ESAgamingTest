<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Army as ModelsArmy;
use App\Http\Resources\BattleSimulator;

class ArmiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($idGame)
    {
        $armies=ModelsArmy::where('gameId',$idGame)->get()->reverse();
        return view('armies',['armies'=>$armies,'gameId'=>$idGame]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($gameId)
    {
        return view('armiesCreate',['gameId'=>$gameId]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newArmy=new ModelsArmy();
        $newArmy->name=$request->name;
        $newArmy->numberOfUnits=$request->numberOfUnits;
        $newArmy->strategy=$request->strategy;
        $newArmy->gameId=$request->gameId;
        $newArmy->saveOrFail();
        return redirect('/armies/index/'.$request->gameId);
    }

    public function nextTurn($gameId)
    {
        BattleSimulator::nextTurn($gameId);
        return redirect('/armies/index/'.$gameId);
    }
}
