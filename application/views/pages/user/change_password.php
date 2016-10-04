<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<h3 class="page-header">Change Password</h3>
  <?php if(validation_errors()){ ?>
  <div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo validation_errors(); ?></div> 
  <?php } ?>
	<form class="form-horizontal" method="post">
  <div class="form-group">
    <label for="name" class="col-sm-3 control-label">Name</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="name" name="name" value="<?php ($userDetails['name'])?print($userDetails['name']):"";?>" placeholder="Full Name">
    </div>
  </div>
  <div class="form-group">
    <label for="password" class="col-sm-3 control-label">Password</label>
    <div class="col-sm-5">
      <input type="password" class="form-control" id="password" name="password" placeholder="Password">
    </div>
  </div>
  <div class="form-group">
    <label for="cpassword" class="col-sm-3 control-label">Confirm Password</label>
    <div class="col-sm-5">
      <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Confirm Password">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-10">
      <button type="submit" class="btn btn-primary" name="save" value="Save">Save</button>
      <a href="/users/edit/<?php ($userDetails['id'])?print($userDetails['id']):"";?>" class="btn btn-primary">Back</a>
    </div>
  </div>
</form>
</div>