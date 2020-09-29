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
        <div>Game id: {{ $game->id }} Status: 
        @if ($game->hasStarted)
            Game have started.
        @else
            Game haven't started yet.
        @endif <a href="/armies/index/{{ $game->id  }}">Enter</a></div>
    @endforeach
</body>
</html>