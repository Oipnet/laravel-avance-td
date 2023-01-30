<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/js/app.js')
</head>
<body>
<nav>
    <form id="form-logout" action="{{ route('login_logout') }}" method="post">
        @method('DELETE')
        @csrf
    </form>
    <a href="" id="logout">Se deconnecter</a>
</nav>
@yield('content')
<script>
    document.querySelector("#logout").addEventListener('click', (e) => {
        e.preventDefault()

        document.querySelector('#form-logout').submit()
    })
</script>
</body>
</html>
