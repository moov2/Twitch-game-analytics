<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="/css/app.css" rel="stylesheet" >

        <title>Twitch Game Analytics</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <nav class="navbar navbar-inverse">
            <h3>Twitch Game Analytics <span class="badge badge-danger etch-play">by Etch Play</span></h3> @if(isset($currentGame->box_art_url)) <span class="game-name float-right">{{$currentGame->name ?? ''}} <a href="{{preg_replace_array('/\{width\}|\{height\}+/', ['1400', '1550'], $currentGame->box_art_url)}}" target="_blank"><img class="game-cover" src="{{preg_replace_array('/\{width\}|\{height\}+/', ['400', '550'], $currentGame->box_art_url)}}"/></a></span>@endif
        </nav>

        <div class="container-fluid mt-5">
            <div class="row card-group">

                <div class="card col-lg-3">
                    <div class="card-body">
                        <h5 class="card-title">Top streams</h5>
                        <p class="card-text">Top streams of last 7 days, based on sum viewers.</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        @if(isset($topStreams))
                        @foreach ($topStreams as $stream)
                        <li class="list-group-item"><a href="https://twitch.tv/{{$stream->user_name}}" target="_blank">{{$stream->user_name}}</a> <span class="badge badge-info float-right">{{number_format($stream->sum)}}</span></li>
                        @endforeach
                        @else
                        <li class="list-group-item">No data found.</li>
                        @endif
                    </ul>
                </div>

                <div class="card col-lg-3">
                    <div class="card-body">
                        <h5 class="card-title">Peak viewers</h5>
                        <p class="card-text">Peak viewers of last 7 days, based on peak viewers.</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        @if(isset($peakStreams))
                            @foreach ($peakStreams as $stream)
                            <li class="list-group-item"><a href="https://twitch.tv/{{$stream->user_name}}" target="_blank">{{$stream->user_name}}</a> <span class="badge badge-info float-right">{{number_format($stream->sum)}}</span></li>
                            @endforeach
                        @else
                        <li class="list-group-item">No data found.</li>
                        @endif
                    </ul>
                </div>

                <div class="card col-lg-3">
                    <div class="card-body">
                        <h5 class="card-title">Longest streams</h5>
                        <p class="card-text">Longest streams of all the time.</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        @if(isset($longestStreams))
                            @foreach ($longestStreams as $stream)
                            <li class="list-group-item"><a href="https://twitch.tv/{{$stream->user_name}}" target="_blank">{{$stream->user_name}}</a> <span class="badge badge-info float-right">{{gmdate("H", $stream->date_diff)}} hours</span></li>
                            @endforeach
                        @else
                        <li class="list-group-item">No data found.</li>
                        @endif
                    </ul>
                </div>

                <div class="card col-lg-3">
                    <div class="card-body">
                        <h5 class="card-title">Top Games</h5>
                        <p class="card-text">Top Games based on current viewers on Twitch.</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <?php $sets = 0 ?>
                        @if(isset($topGames))
                            @foreach ($topGames as $games)
                                <?php if($sets == 1): ?>
                                    <li class="list-group-item text-center">...</li>
                                <?php endif; ?>
                                
                                @foreach ($games as $game)
                                    <li class="list-group-item {{isset($game->isCurrentGame) ? 'is-current-game' : ''}}"><span class="badge {{isset($game->isCurrentGame) ? 'badge-danger' : 'badge-info'}}">{{$game->top_game_id}}</span> {{$game->name}}</li>
                                @endforeach
                            <?php $sets++ ?>
                            @endforeach
                        @else
                        <li class="list-group-item">No data found.</li>
                        @endif
                    </ul>
                </div>

            </div>
        </div>

        <footer class="container-fluid mt-5 mb-5">
            <p class="text-center">A project by <a href="https://etchplay.com">Etch Play</a></p>
        </footer>
    </body>
</html>
