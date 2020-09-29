<?php

// echo '<br>';
// echo "Battle simulator
// -----------------------------------------

// Once at least 5 armies have joined, the battle can start. When the start action is called, the armies start to attack.

// **Attack and strategies**

// Random: Attack a random army

// Weakest: Attack the army with the lowest number of units

// Strongest: Attack the army with the highest number of units


// Attack chances
// - Not every attack is successful. Army has 1% of success for every alive unit in it.

// Attack damage
// - The army always does 0.5 damage per unit, when an attack is successful. If there is only one unit left, the damage is 1.

// Received damage
// - For every whole point of received damage from the attacking army, one unit is removed from the attacked army.

// Reload time
// -Reload time takes 0.01 seconds per 1 unit in the army.



// The army is dead (defeated) when all units are dead. 
// The battle is over when there is one army standing.

// Armies attack one by one. The order is defined in the order of adding the armies.

// If the new army is added in between turns, it will be added to the beginning of the order, and in the next turn, the army which was first will now be second and so on.";
 
class Army
{
    public $name;
    public $numberOfUnits;
    public $strategy;

    function __construct($name,$numberOfUnits=100,$strategy='random')
    {
        $this->name=$name;
        if($numberOfUnits>=80 and $numberOfUnits<=100)
        {
            $this->numberOfUnits=$numberOfUnits;
        }
        else
        {
            $this->numberOfUnits=100;
        }

        if($strategy=='random' or $strategy=='weak' or $strategy=='strong')
        {
            $this->strategy=$strategy;
        }
        else
        {
            $this->strategy='random';
        }
    }

    public function showArmy()
    {
        return " $this->name army that have $this->numberOfUnits units remain and $this->strategy strategy!";
    }
}

$army1=new Army('prva', 100, 'weak');
// $army1->showArmy();
$army2=new Army('druga', 90, 'weak');
$army3=new Army('treca', 85, 'strong');
$army4=new Army('cetvrta', 80, 'random');
$army5=new Army('peta', 95, 'random');

class Battle
{
    public $armyList=[];

    function __construct()
    {

    }

    public function addArmy($army)
    {
        array_unshift($this->armyList,$army);
    }

    public function simulator()
    {
        if(count($this->armyList)>=5)
        {
            while(count($this->armyList)>1)
            {
                $this->combatTurn();
            }
            echo '<br><hr>Victorious army is '.$this->armyList[0]->showArmy().'<hr><br>';
        }
    }

    public function combatTurn()
    {
        foreach($this->armyList as $army)
        {
            $damageInTurn=$this->attackDamageValue($army->numberOfUnits);
            if($army->strategy=='random')
            {
                $this->reduceNumberOfUnits($this->randomArmy(),$damageInTurn);
            }
            if($army->strategy=='weak')
            {
                $this->reduceNumberOfUnits($this->weakestArmy(),$damageInTurn);
            }
            if($army->strategy=='strong')
            {
                $this->reduceNumberOfUnits($this->strongestArmy(),$damageInTurn);
            }
        }
    }

    public function reduceNumberOfUnits($target,$damageInTurn)
    {
        $targetIndex=$this->findArmyNumber($target->name);
        $this->armyList[$targetIndex]->numberOfUnits-=$damageInTurn;
        if($this->armyList[$targetIndex]->numberOfUnits<=0) $this->deleteArmy($targetIndex);
    }

    public function strongestArmy()
    {
        $result=[];
        $max=0;
        foreach ($this->armyList as $army)
        {
            if($army->numberOfUnits>$max) $max=$army->numberOfUnits;
        }
        foreach ($this->armyList as $army)
        {
            if($army->numberOfUnits==$max) array_push($result,$army);
        }
        
        $count=count($result);
        $randomArmy=rand(0,$count-1);
        return $result[$randomArmy];
    }

    public function weakestArmy()
    {
        $result=[];
        $min=1000;
        foreach ($this->armyList as $army)
        {
            if($army->numberOfUnits<$min) $min=$army->numberOfUnits;
        }
        foreach ($this->armyList as $army)
        {
            if($army->numberOfUnits==$min) array_push($result,$army);
        }
        
        $count=count($result);
        $randomArmy=rand(0,$count-1);
        return $result[$randomArmy];
    }

    public function randomArmy()
    {
        $count=count($this->armyList);
        $randomArmy=rand(0,$count-1);
        return $this->armyList[$randomArmy];
    }

    public function attackDamageValue($numberOfUnits)
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

    public function findArmyNumber($name)
    {
        $count=count($this->armyList);
        for ($i=0;$i<$count;$i++)
        {
            if($this->armyList[$i]->name==$name) return $i;
        }
    }

    public function deleteArmy($index)
    {
        echo "<br> Army ".$this->armyList[$index]->name." have been defeated <br>";
        array_splice($this->armyList,$index,1);
    }
}

$battle=new Battle();
$battle->addArmy($army1);
$battle->addArmy($army2);
$battle->addArmy($army3);
$battle->addArmy($army4);
$battle->addArmy($army5);
// var_dump($battle->strongestArmy());
// var_dump($battle->weakestArmy());
// var_dump($battle->randomArmy());
// var_dump($battle->attackDamageValue(100));
// var_dump($battle->findArmyNumber('prva'));
// $battle->deleteArmy(4);
// var_dump($battle->armyList);
$battle->simulator();


echo '<br> End of program!';
