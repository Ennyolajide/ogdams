<html>
    <head></head>
    <body>

        {{-- <img src="https://www.google.com.ng/images/branding/googlelogo/1x/googlelogo_color_272x92dp.png"> --}}
        <p>{{ $content }}</p>

        @if(isset($link))
            <p> Click <a href="{{ $link }}">here</a> if the above link is not working</p>
        @endif
    </body>
</html>
