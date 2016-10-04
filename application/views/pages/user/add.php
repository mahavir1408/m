<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<h3 class="page-header">Add User</h3>
  <?php if(validation_errors()){ ?>
  <div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo validation_errors(); ?></div> 
  <?php } ?>
	<form class="form-horizontal" method="post">
  <div class="form-group">
    <label for="name" class="col-sm-3 control-label">Name</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="name" name="name" placeholder="Full Name">
    </div>
  </div>
  <div class="form-group">
    <label for="username" class="col-sm-3 control-label">Username (Login Name)</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="username" name="username" placeholder="User Name">
    </div>
  </div>
  <div class="form-group">
    <label for="email" class="col-sm-3 control-label">Email</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="email" name="email" placeholder="Email">
    </div>
  </div>
  <div class="form-group">
    <label for="mobile" class="col-sm-3 control-label">Mobile#</label>
    <div class="col-sm-5">
      <input type="mobile" class="form-control" id="mobile" name="mobile" placeholder="Mobile Number">
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
      <div class="checkbox">
        <label>
          <input name="administrator" type="checkbox"> Administrator
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-10">
      <div class="checkbox">
        <label>
          <input name="activate" type="checkbox"> Activate
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-10">
      <button type="submit" class="btn btn-primary">Save</button>
      <a href="/users" class="btn btn-primary">Back</a>
    </div>
  </div>
</form>
</div>