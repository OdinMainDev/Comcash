<form action="/auth/login" method="post">
    @csrf
    <input type="text" name="email" id="email">
    <input type="password" name="password" id="password">
    <button type="submit">Sign in</button>
</form>