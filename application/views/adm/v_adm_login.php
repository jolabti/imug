<html>
<title>LOGIN - Instant Messaging UG</title
<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link href="<?= base_url();?>assets/administrator/css/customadm.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="container">
	<div class="login-container">
            <div id="output"></div>
            <div class="avatar">

            </div>
            <div class="form-box">

                <p class="btn btn-primary badge ">IM-UG</p>
                <hr>
                <form action="<?= site_url('feed/auth_login')?>" method="post">
                    <input name="user" type="text" placeholder="username">
                    <input type="password" placeholder="password" name="password">
                    <button class="btn btn-info btn-block login" type="submit">Login</button>
                </form>
            </div>
        </div>

</div>
