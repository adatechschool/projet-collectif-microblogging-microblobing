<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>post</title>

    </head>
    <body>
        <h1>{{ $displayPost->title }}</h1>
        <p>{{ $displayPost->content }}</p>
    </body>