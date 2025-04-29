<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skor Tenis Meja</title>
    <style>
        body {
            font-family: sans-serif;
            text-align: center;
            background-color: #f1f3f4;
            margin: 0;
            padding: 0;
        }

        .scoreboard {
            background: url('https://via.placeholder.com/1200x800/ffffff/000000?text=Game+Controller+Skor') no-repeat center center;
            background-size: cover;
            border-radius: 20px;
            padding: 40px;
            width: 800px;
            margin: 50px auto;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            color: #000000;
            text-shadow: none;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h1 {
            color: #000000;
            font-size: 2rem;
            margin-bottom: 20px;
            width: 100%;
            text-align: center;
        }

        .set-info {
            margin-bottom: 20px;
            font-size: 1.2rem;
            color: #000000;
        }

        .scores {
            display: flex;
            justify-content: space-between;
            width: 100%;
            font-size: 2rem;
            color: #000000;
            margin-bottom: 30px;
        }

        .score {
            text-align: center;
            width: 40%;
        }

        .controller-button {
            padding: 20px;
            margin: 15px;
            border: none;
            background-color: #007bff;
            color: white;
            font-size: 1.5rem;
            border-radius: 50%;
            cursor: pointer;
            width: 80px;
            height: 80px;
            display: inline-block;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
            transition: background-color 0.3s ease, transform 0.1s ease;
        }

        .controller-button:hover {
            background-color: #0056b3;
            transform: scale(1.1);
        }

        .controller-button:active {
            transform: scale(1);
        }

        .reset-button, .toggle-set-button {
            padding: 12px 25px;
            margin-top: 20px;
            font-size: 1.2rem;
            border-radius: 25px;
            background-color: #28a745;
            color: white;
            cursor: pointer;
            border: none;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        .reset-button:hover, .toggle-set-button:hover {
            background-color: #218838;
        }

        form {
            display: inline-block;
            margin: 10px;
        }

    </style>
</head>
<body>
    <div class="scoreboard">
        <h1>🏓 Skor Tenis Meja</h1>

        <div class="set-info">
            <strong>Max Set:</strong> {{ $maxSet }} Set (Best of {{ $maxSet }}) <br>
            <strong>Menang jika menang {{ ceil($maxSet / 2) }} set</strong>
        </div>

        <div class="scores">
            <div class="score">
                <strong>Player A:</strong> {{ $scoreA }}<br>
                <strong>Set A:</strong> {{ $setA }}<br>
                @if(!isset($winner))
                    <form method="POST" action="{{ route('score.add', 'A') }}">
                        @csrf
                        <button type="submit" class="controller-button">A+</button>
                    </form>
                @endif
            </div>
            <div class="score">
                <strong>Player B:</strong> {{ $scoreB }}<br>
                <strong>Set B:</strong> {{ $setB }}<br>
                @if(!isset($winner))
                    <form method="POST" action="{{ route('score.add', 'B') }}">
                        @csrf
                        <button type="submit" class="controller-button">B+</button>
                    </form>
                @endif
            </div>
        </div>

        @if(isset($winner))
            <div class="winner-info" style="font-size: 1.5rem; color: #28a745;">
                <strong>{{ $winner }} Wins!</strong>
            </div>
        @endif

        <form method="POST" action="{{ route('score.reset') }}">
            @csrf
            <button type="submit" class="reset-button">Reset</button>
        </form>

        <form method="POST" action="{{ route('score.toggle') }}">
            @csrf
            <button type="submit" class="toggle-set-button">Toggle Set</button>
        </form>
    </div>
</body>
</html>
