<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>To Do List</title>
    @vite('resources/css/app.css')
</head>

<body class="{{$background}}">

<nav>
    <x-nav-link href="/" :active="request()->is('/', 'in/progress', 'to/do', 'done')">
        Home
    </x-nav-link>

    @auth
        <form action="/logout" method="POST" class="right">
            @csrf
            <button type="submit" style="background-color:darkgray;border-style:hidden;margin-top:5px">Logout</button>
        </form>
    @endauth

    @guest
        <x-nav-link href="/register" :active="request()->is('register')" class="right">Sign up</x-nav-link>
        <x-nav-link href="/login" :active="request()->is('login')" class="right">Login</x-nav-link>
    @endguest
</nav>

<main>
    {{$slot}}
</main>

</body>
</html>
