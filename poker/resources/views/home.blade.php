<html>
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body>
        <p> Your cards are {{ implode(',', $cards) }} </p>

        @foreach($cards as $card)
            <span><img src="img/{{$card}}.jpg"></span>
        @endforeach

        <p> and {{$msg}}
    </body>
    <footer>
        <script src="{{ mix('js/app.js') }}"></script>
    </footer>
    
</html>