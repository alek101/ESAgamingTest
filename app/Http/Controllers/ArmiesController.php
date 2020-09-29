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
        $armies=ModelsArmy::where('gameId',$idGame)->where('numberOfUnits','>',0)->get()->reverse();
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
        if($request->numberOfUnits>=80 and $request->numberOfUnits<=100)
        {
            $newArmy->numberOfUnits=$request->numberOfUnits;
        }
        elseif($request->numberOfUnits<80)
        {
            $newArmy->numberOfUnits=80;
        }
        else
        {
            $newArmy->numberOfUnits=100;
        }
        if($request->strategy=='random' or $request->strategy=='weak' or $request->strategy=='strong')
        {
            $newArmy->strategy=$request->strategy;
        }
        else
        {
            $newArmy->strategy='random';
        }
        $newArmy->gameId=$request->gameId;
        $newArmy->saveOrFail();
        return redirect('/armies/index/'.$request->gameId);
    }

    public function nextTurn($gameId)
    {
        $response=BattleSimulator::nextTurn($gameId);
        return redirect('/armies/index/'.$gameId)->withErrors($response);
    }

    public function autoFinish($gameId)
    {
        $response=BattleSimulator::autoFinish($gameId);
        return redirect('/armies/index/'.$gameId)->withErrors($response);
    }
}
