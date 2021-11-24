<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <div class="loginForm">
            <form action="dispatcher.php" method="post">
                <input type="hidden" name="action" value="login">
                <div class="mb-3 form-floating">
                    <input class="form-control loginInput" type="text" id="username" placeholder="username" name="username">
                    <label class="form-label" for="username">Username</label>
                </div>
                <div class="mb-3 form-floating">
                    <input class="form-control loginInput" type="password" id="password" placeholder="password" name="password">
                    <label class="form-label" for="password">Password</label>
                </div>
                <button class="btn btn-primary" type="submit">Login</button>
            </form>
        </div>
    </div>
</div>