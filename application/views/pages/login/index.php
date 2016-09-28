<body>
<div class="container">    
	<form class="form-signin" action="" method="post" name="login">
    <?php if(validation_errors()){ ?>
    <div class="alert alert-danger" role="alert">
    <?php echo validation_errors(); ?>
    </div>  
    <?php } ?>
    <?php if(isset($companies) && !empty($companies)) { ?>
    <h2 class="form-signin-heading">Please sign in</h2>
    <label for="username" class="sr-only">Username</label>
    <input type="text" size="29" id="username" name="username" class="form-control" placeholder="Username" required autofocus>
    <label for="password" class="sr-only">Password</label>
    <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
    <select class="form-control" name="company" onchange="document.getElementById('company_name').value=this.options[this.selectedIndex].text">
        <option value="">Select Company</option>        
        <?php foreach($companies AS $company) { ?>
        <option value="<?php echo $company['id']; ?>"><?php echo $company['name']; ?></option>
        <?php } ?>
    </select>
    <input type="hidden" id="company_name" name="company_name" value=""/>
    <br />
    <button class="btn btn-lg btn-primary btn-block form-control" type="submit">Sign in</button>
    <?php } else { ?>
    <div class="alert alert-danger" role="alert">No companies added, Please add companies to proceed!!</div>
    <?php } ?>
	</form>
</div> <!-- /container -->
</body>
</html>