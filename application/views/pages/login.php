<body>
<div class="container">
  	<form class="form-signin" action="" method="post" name="login">
		<?php if(validation_errors()){ ?>
		<div class="notify notify-error"><?php echo validation_errors(); ?></div>	
		<?php } ?>
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="username" class="sr-only">Username</label>
        <input type="text" size="29" id="username" name="username" class="form-control" placeholder="Username" required autofocus>
        <label for="password" class="sr-only">Password</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
  	</form>
</div> <!-- /container -->
</body>
</html>