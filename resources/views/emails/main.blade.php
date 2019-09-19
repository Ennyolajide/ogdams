<html>
    <head></head>
    <body>

        <img src="{{ $logo }}">
        <p>{{ $content }}</p>

        @if(isset($link))
            <p> Click <a href="{{ $link }}">here</a> if the above link is not working</p>
        @endif
    </body>
</html>
