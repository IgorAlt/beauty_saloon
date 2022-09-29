<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $post->name}}</title>
</head>
<body>
    <h1>{{ $post->name }}</h1>
    <p>{{ $post->post }}</p>
    <img width="300px" src="{{ \Illuminate\Support\Facades\Storage::url($post->images) }}" alt="{{ $post->name }}">
</body>
</html>
