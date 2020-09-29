<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
    <a href="/armies/create/{{ $gameId }}">Add Army</a> <br>
    <a href="/armies/nextTurn/{{ $gameId }}">Next Turn</a> <br>
    <a href="/armies/autoFinish/{{ $gameId }}">Auto turn</a> <br>
    <a href="/">Back</a> <br>
    @foreach ($errors->all() as $error)
            <p class="r_error">{{ $error }}</p>
    @endforeach

    @foreach ($armies as $army)
        <div>Army id: {{ $army->id }} Name: {{ $army->name }} Units: {{ $army->numberOfUnits }} Strategy: {{ $army->strategy }}</div>
    @endforeach
</body>
</html>