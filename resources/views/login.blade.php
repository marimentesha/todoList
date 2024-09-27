<x-layout>

    <x-slot:background>bg</x-slot:background>
    <form action="/login" method="post">
        @csrf
        <label for="email">email:</label>
        <input type="email" id="email" name="email">
        <x-error name="email"/>

        <label for="password">password:</label>
        <input type="password" id="password" name="password">
        <x-error name="password"/>

        <button type="submit">log in</button>
    </form>
    <p style="text-align:center">don't have an account?
        <a href="/register" style="text-decoration:underline;color:blue;font-size:medium;">sign up</a>
    </p>

</x-layout>
