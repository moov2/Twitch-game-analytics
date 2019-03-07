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
            <h3>Twitch Game Analytics <span class="badge badge-danger">by Etch Play</span></h3> Call of Duty: Black Ops 4
        </nav>

        <div class="container-fluid mt-3">
            <div class="row">

                <div class="card col-lg-3">
                    <div class="card-body">
                        <h5 class="card-title">Top streams</h5>
                        <p class="card-text">Top streams of last 7 days, based on sum viewers.</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        @foreach ($topStreams as $stream)
                        <li class="list-group-item"><a href="https://twitch.tv/{{$stream->user_name}}" target="_blank">{{$stream->user_name}}</a> <span class="badge badge-info float-right">{{number_format($stream->sum)}}</span></li>
                        @endforeach
                    </ul>
                </div>

                <div class="card col-lg-3">
                    <div class="card-body">
                        <h5 class="card-title">Peak viewers</h5>
                        <p class="card-text">Peak viewers of last 7 days, based on peak viewers.</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        @foreach ($peakStreams as $stream)
                        <li class="list-group-item"><a href="https://twitch.tv/{{$stream->user_name}}" target="_blank">{{$stream->user_name}}</a> <span class="badge badge-info float-right">{{number_format($stream->sum)}}</span></li>
                        @endforeach
                    </ul>
                </div>

                <div class="card col-lg-3">
                    <div class="card-body">
                        <h5 class="card-title">Longest streams</h5>
                        <p class="card-text">Longest streams of all the time.</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        @foreach ($longestStreams as $stream)
                        <li class="list-group-item"><a href="https://twitch.tv/{{$stream->user_name}}" target="_blank">{{$stream->user_name}}</a> <span class="badge badge-info float-right">{{gmdate("H", $stream->date_diff)}} hours</span></li>
                        @endforeach
                    </ul>
                </div>

                <div class="card col-lg-3">
                    <div class="card-body">
                        <h5 class="card-title">Top streams of the week</h5>
                        <p class="card-text">Top streams of the week, based on peak viewers.</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Cras justo odio</li>
                        <li class="list-group-item">Dapibus ac facilisis in</li>
                        <li class="list-group-item">Vestibulum at eros</li>
                    </ul>
                </div>

            </div>
        </div>
    </body>
</html>
