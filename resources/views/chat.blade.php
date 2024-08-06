<!DOCTYPE html>
<html>
<head>
    <title>Laravel WebSockets Chat</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div id="app">
            <chat-component></chat-component>
        </div>
    </div>
   <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>