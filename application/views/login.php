<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php base_url(); ?>assets/css/bootstrap.min.css">
    <title>Login User</title>
</head>
<style>
    .form-signin {
        width: 100%;
        max-width: 330px;
        padding: 15px;
        margin: auto;
        transform: translate(0,50%);
    }

    form {
        display: block;
        margin-top: 0em;
    }

    .text-center {
        text-align: center !important;
    }

    hr {
        background-color: #B0E0E6;
    }
</style>

<body>
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
</body>

</html>