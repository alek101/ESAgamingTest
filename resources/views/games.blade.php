<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
    <a href="/games/store">New Game</a>

    @foreach ($games as $game)
        <div>Game id: {{ $game->id }} Status: {{ $game->hasStarted }} <a href="/armies/index/"{{ $game->id  }}></a></div>
    @endforeach
</body>
</html>