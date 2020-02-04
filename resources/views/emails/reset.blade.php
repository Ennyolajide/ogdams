<html>
    <head></head>
    <body>

        <img src="{{ $logo }}">
        <br/>
        <p>{{ ucwords($name) }}</p>
        <p>
            We received a request for password reset from your email, if you initialize this request pls click <a href="{{ $link }}">Here</a> to reset your password otherwise ignore this email
        </p>


        <p>
            Copy and paste this into your browser if the link above is not working
            <code>{{ $link }}</code>
        </p>

    </body>
</html>
