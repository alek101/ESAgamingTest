<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
    Number of units must be beetwen 80 and 100. <br>
    <form action="/armies/store" method="POST">
        @csrf
        <input type="number" name="gameId" value="{{ $gameId }}" hidden required>
        Name: <input type="text" name="name" required>
        Number of Units: <input type="number" name="numberOfUnits" required>
        Strategy: 
        <select name="strategy" id="">
            <option value="random">Attack random</option>
            <option value="weak">Attack weakest</option>
            <option value="strong">Attack strongest</option>
        </select>
        <input type="submit" value="Add new army">
    </form>
</body>
</html>