<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <title>Добавить пост</title>
</head>
<body>
<div class="col-md-12">
    @isset($posts_admin)
        <h1>Редактировать пост <b>{{ $posts_admin->name_post }}</b></h1>
    @else
        <h1>Добавить пост</h1>
    @endisset

    <form method="POST" enctype="multipart/form-data"
          @isset($posts_admin)
          action="{{ route('posts_admin.update', $posts_admin) }}"
          @else
          action="{{ route('posts_admin.store') }}"
        @endisset
    >
        <div>
            @isset($posts_admin)
                @method('PUT')
            @endisset
            @csrf
            <div class="input-group row">
                <label for="name_post" class="col-sm-2 col-form-label">Название: </label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name_post" id="name_post"
                           value="@isset($posts_admin){{ $posts_admin->name_post }}@endisset">
                </div>
            </div>
            <br>
            <div class="input-group row">
                <label for="post" class="col-sm-2 col-form-label">Содержание: </label>
                <div class="col-sm-6">
							<textarea name="post" id="post" cols="72"
                                      rows="7">@isset($posts_admin){{ $posts_admin->post }}@endisset</textarea>
                </div>
            </div>
            <br>
            <div class="input-group row">
                <label for="images" class="col-sm-2 col-form-label">Картинка: </label>
                <div class="col-sm-10">
                    <label class="btn btn-default btn-file">
                        Загрузить <input type="file" style="display: none;" name="images" id="images">
                    </label>
                </div>
            </div>
            <button class="btn btn-success">Сохранить</button>
        </div>
    </form>
</div>
</body>
</html>
