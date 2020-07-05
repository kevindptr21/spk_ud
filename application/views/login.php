<form class="form-signin" style="border:2px solid;" method="post" action="<?php base_url()?>auth/authentication">
    <h1 class="mb-3">Login</h1>
    <hr/>
    <label for="inputEmail">Username</label>
    <input type="text" class="form-control" placeholder="Username" required="" name="uname">
    <br/>
    <label for="inputPassword">Password</label>
    <input type="password" class="form-control" placeholder="Password" required="" name="pass"> 
    <br/>
    <div class="d-flex justify-content-center">
        <button class="btn btn-lg btn-primary" type="submit">SIGN IN</button>
    </div>
</form>