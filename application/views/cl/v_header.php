<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Instant Messaging - UG</title>
    <!-- Bootstrap core CSS -->
    <link href="<?= base_url();?>assets/client/css/bootstrap.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="<?= base_url();?>assets/client/css/font-awesome.css" rel="stylesheet">
    <link href="<?= base_url();?>assets/client/css/style.css" rel="stylesheet">
  </head>

  <body>
    <!-- <header>
      <div class="container">
        <img src="img/logo.png" class="logo">
        <form class="form-inline">
          <div class="form-group">
            <label class="sr-only" for="exampleInputEmail3">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail3" placeholder="Enter email">
          </div>
          <div class="form-group">
            <label class="sr-only" for="exampleInputPassword3">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword3" placeholder="Password">
          </div>
          <button type="submit" class="btn btn-default">Sign in</button><br>
          <div class="checkbox">
            <label>
              <input type="checkbox"> Remember me
            </label>
          </div>
        </form>
      </div>
    </header> -->
    <nav class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="index.html">Home</a></li>
            <li><a href="members.html">Members</a></li>
            <li><a href="groups.html">Groups</a></li>
            <li><a href="<?= site_url("feed/logout");?>">Logout</a></li>
            <!-- <li><a href="photos.html">Photos</a></li>
            <li><a href="profile.html">Profile</a></li> -->
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
