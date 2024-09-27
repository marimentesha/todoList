<x-layout>

    <x-slot:background>bg</x-slot:background>

    <form action="/register" method="post">
        @csrf
        <label for="first">first name:</label>
        <input type="text" id="first" name="first">
        <x-error name="first"/>

        <label for="last">last name:</label>
        <input type="text" id="last" name="last">
        <x-error name="last"/>

        <label for="email">email address:</label>
        <input type="email" id="email" name="email">
        <x-error name="email"/>

        <label for="phone">phone number:</label>
        <input type="tel" id="phone" name="phone">
        <x-error name="phone"/>

        <label for="password">create password:</label>
        <input type="password" id="password" name="password">
        <x-error name="password"/>

        <label for="password_repeat">repeat password:</label>
        <input type="password" id="password_repeat" name="password_repeat">
        <x-error name="password_repeat"/>

        <button type="submit">register</button>
    </form>

    <p style="text-align:center;">already have an account?
        <a href="/login" style="text-decoration:underline;color:blue;font-size:medium;">log in</a>
    </p>

</x-layout>
