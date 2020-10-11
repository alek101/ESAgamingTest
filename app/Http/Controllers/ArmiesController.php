<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Army as ModelsArmy;
use App\Http\Resources\BattleSimulator;
use App\Http\Resources\Corrector;

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
        $validatedAttributes=$request->validate([
            'name'=>'required',
            'numberOfUnits'=>'required|numeric',
            'strategy'=>'required',
            'gameId'=>'required'
        ]);

        $validatedAttributes['numberOfUnits']=Corrector::correctArmySize($validatedAttributes['numberOfUnits']);
        $validatedAttributes['strategy']=Corrector::correctStrategy($validatedAttributes['strategy']);

        ModelsArmy::create($validatedAttributes);

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
