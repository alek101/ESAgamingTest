## Interview test

## Installation
1. Install php and MySql
https://www.apachefriends.org/download.html
2. install composer: https://getcomposer.org/download/
3. Download app from git
(Run in cmd)
4. composer global require laravel/installer
(Run in cmd folder where app is downloaded from git)
5. composer install
(turn on browser)
6. Create database http://localhost/phpmyadmin/index.php
(go in folder where you downloaded app from git)
7. Create env file and set database name in env file (if there is none copy from env.example)
(Run in cmd folder where app is downloaded from git)
8. php artisan migrate
9. php artisan serve
10. http://127.0.0.1:8000
11. Turn off server in cmd where is runned with control+C on keyboard


## PHP Engineer testing task - Battle Simulator
This is a test used to assess the candidates for the PHP Back-End Developer position.

Task description
-------------------------------

The goal of this task is to build an app simulator between 5 and 'n' armies in at most 5 different battles active. The system consists of two functional segments.

1. REST API for triggering system commands
2. Battle simulator


REST API
-------------------------------
The REST API is straightforward. Here is the list of the API Routes.

**Create a Game**
The API call to create a game and return an ID for the game.

**Add Army**
Add the army to the game. This API accepts:

**Name**
Name of the army

**Units**
Number of units the army has (80 - 100)

**Attack strategy**
Based on the attacking strategy the army chose whom to attack

**List games**
List existing games, their status, units, ids.

**Run attack**
The API call to start the game or run an attack. If this is the first time calling this command, it can execute only if there are at least 5 armies. 


Battle simulator
-----------------------------------------

Once at least 5 armies have joined, the battle can start. When the start action is called, the armies start to attack.

**Attack and strategies**

Random: Attack a random army

Weakest: Attack the army with the lowest number of units

Strongest: Attack the army with the highest number of units


Attack chances
- Not every attack is successful. Army has 1% of success for every alive unit in it.

Attack damage
- The army always does 0.5 damage per unit, when an attack is successful. If there is only one unit left, the damage is 1.

Received damage
- For every whole point of received damage from the attacking army, one unit is removed from the attacked army.

Reload time
-Reload time takes 0.01 seconds per 1 unit in the army.



The army is dead (defeated) when all units are dead. 
The battle is over when there is one army standing.

Armies attack one by one. The order is defined in the order of adding the armies.

If the new army is added in between turns, it will be added to the beginning of the order, and in the next turn, the army which was first will now be second and so on.


UI
----------------------
Create as simple as possible UI Interface. UI Interface is used to create a game, add units to the game, run the battle and show the round status. Please do not run game logic on the front-end.
Also, add the “autorun” option to the game UI so, after every turn, the game will run automatically, without waiting for the button “run” to be clicked.

Database
----------------------
Use MySQL or Postgresql

Framework
----------------------
You can use any framework or a custom approach to solve this task.

Conditions
----------------------
- On refresh, the game must continue from before refresh.
- The task must be submitted as a Git URL through this Form
- Provide Readme.md instructions with how to install and prerequisites.