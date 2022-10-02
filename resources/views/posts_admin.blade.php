<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <title>Посты</title>
</head>
<body>
<h1>Посты</h1>
<table class="table">
    <thead>
    <tr>
        <th scope="col">Id</th>
        <th scope="col">Название</th>
        <th scope="col">Фото</th>
        <th width="400px" scope="col">Содержание</th>
        <th scope="col">Действия</th>
    </tr>
    </thead>
    <tbody>
    @foreach($posts as $post)
        <tr>
            <th scope="row">{{ $post->id }}</th>
            <td>{{ $post->name_post }}</td>
            <td><img width="100px" src="{{ $post->image_path }}" alt="{{ $post->images }}"></td>
            <td>{{ $post->post }}</td>
            <td>
                <div class="btn-group" role="group">
                    <form action="{{ route('posts_admin.destroy', $post) }}" method="POST">
                        <a class="btn btn-warning" type="button" href="{{ route('posts_admin.edit', $post) }}">Редактировать</a>
                        @csrf
                        @method('DELETE')
                        <input class="btn btn-danger" type="submit" value="Удалить"></form>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<a class="btn btn-success" type="button" href="{{ route('posts_admin.create') }}">Добавить пост</a>
</body>
</html>
