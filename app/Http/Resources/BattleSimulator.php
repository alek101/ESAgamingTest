<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Game as ModelsGame;
use App\Models\Army as ModelsArmy;

class BattleSimulator extends JsonResource
{
    public static function nextTurn($gameId)
    {
        $armyList=ModelsArmy::where('gameId',$gameId)->where('numberOfUnits','>',0)->get()->reverse();
        
        $game=ModelsGame::findOrFail($gameId);

        if($armyList->count()>1)
        {
            if($game->hasStarted)
            {
                BattleSimulator::combatTurn($armyList);  
            }
            else
            {
                if($armyList->count()>=5)
                {
                    $game->hasStarted=true;
                    $game->saveOrFail();
                    BattleSimulator::combatTurn($armyList);  
                }
                else
                {
                    return 'error';
                }
            }
        }
        else
        {
            if($game->hasStarted)
            {
                echo "Army".$armyList[0]->name."has won";
                return 'completed';
            }
            else
            {
                return 'error';
            }
        }

        return 'inProgress';
    }

    public static function autoFinish($gameId)
    {
       $check=BattleSimulator::nextTurn($gameId);
       if($check=='inProgress')
       {
           while($check=='inProgress')
           {
               $check=BattleSimulator::nextTurn($gameId);
           }
       }
    }

    public static function combatTurn($armyList)
    {
        foreach($armyList as $army)
        {
            $damageInTurn=BattleSimulator::attackDamageValue($army->numberOfUnits);
            
            if($army->strategy=='random')
            {
                BattleSimulator::reduceNumberOfUnits(BattleSimulator::randomArmy($armyList),$damageInTurn, $armyList);
            }
            if($army->strategy=='weak')
            {
                BattleSimulator::reduceNumberOfUnits(BattleSimulator::weakestArmy($armyList),$damageInTurn, $armyList);
            }
            if($army->strategy=='strong')
            {
                BattleSimulator::reduceNumberOfUnits(BattleSimulator::strongestArmy($armyList),$damageInTurn, $armyList);
            }
        }
    }

    public static function reduceNumberOfUnits($target,$damageInTurn)
    {
        $targetedArmy=ModelsArmy::findOrFail($target->id);
        $targetedArmy->numberOfUnits-=$damageInTurn;
        $targetedArmy->saveOrFail();
    }

    public static function strongestArmy($armyList)
    {
        $result=[];
        $max=0;
        foreach ($armyList as $army)
        {
            if($army->numberOfUnits>$max) $max=$army->numberOfUnits;
        }
        foreach ($armyList as $army)
        {
            if($army->numberOfUnits==$max) array_push($result,$army);
        }
        
        $count=count($result);
        $randomArmy=rand(0,$count-1);
        return $result[$randomArmy];
    }

    public static function weakestArmy($armyList)
    {
        $result=[];
        $min=1000;
        foreach ($armyList as $army)
        {
            if($army->numberOfUnits<$min) $min=$army->numberOfUnits;
        }
        foreach ($armyList as $army)
        {
            if($army->numberOfUnits==$min) array_push($result,$army);
        }
        
        $count=count($result);
        $randomArmy=rand(0,$count-1);
        return $result[$randomArmy];
    }

    public static function randomArmy($armyList)
    {
        $count=count($armyList);
        $randomArmy=rand(0,$count-1);
        return $armyList[$randomArmy];
    }

    public static function attackDamageValue($numberOfUnits)
    {
        $damage=0;
        if($numberOfUnits>1)
        {
            for($i=0;$i<$numberOfUnits;$i++)
            {
                if(rand(0,99)==99)
                {
                    $damage=$damage+0.5;
                }
            }
        }
        else
        {
            if(rand(0,99)==99)
            {
                $damage=1;
            }
        }
        return $damage;
    }

}
