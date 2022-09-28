<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <title>Новости</title>
</head>
<body>
    <h1>Новости</h1>
    @foreach($posts as $post)
        <div class="card" style="width: 25rem; display: inline-flex">
            <img src="{{ \Illuminate\Support\Facades\Storage::url($post->images) }}" class="card-img-top" alt="{{ $post->name }}">
            <div class="card-body">
                <h5 class="card-title">{{ $post->name }}</h5>
                <p class="card-text">{{ $post->post }}</p>
            </div>
        </div>
    @endforeach
</body>
</html>
