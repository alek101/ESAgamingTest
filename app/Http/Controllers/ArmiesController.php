<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Army as ModelsArmy;

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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
