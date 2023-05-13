<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

</head>
<body>

    <div id="app">
        <router-view :key="$route.fullPath"></router-view>
    </div>

</body>
<!-- REQUIRED SCRIPTS -->
<script src="{{ asset('js/app.js') }}"></script>
</html>
