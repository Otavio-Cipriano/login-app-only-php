<div style="width: 100%; height: 100vh; display: grid;">
    <form action="/login" method="POST" class="form p-3"
          style="background-color: #efefef; max-width: 500px; margin: auto; width: 100%; border-radius: 10px">
        <div>
            <label for="inputNome" class="form-label">E-mail</label>
            <input name="email" type="email" id="inputNome" class="form-control"/>
            <div class="form-text text-danger">{{error_email}}</div>
        </div>
        <div>
            <label for="inputEmail" class="form-label">Password</label>
            <input name="password" type="password" id="inputEmail" class="form-control"/>
            <div class="form-text text-danger">{{error_password}}</div>
        </div>
        <div class="text-center mt-3">
            <button class="btn btn-primary " type="submit">Login</button>
            <a href="/signin" class="btn btn-secondary">Register</a>
        </div>
    </form>
</div>