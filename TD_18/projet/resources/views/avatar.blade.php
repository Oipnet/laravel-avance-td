<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="{{ route('avatar_upload') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="avatar">Avatar</label>
    <input type="file" name="avatar">
    <input type="submit" value="Envoyer">
</form>
</body>
</html>
