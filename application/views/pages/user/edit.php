<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<h3 class="page-header">Edit User</h3>
  <?php if($this->session->flashdata('success')){ ?>
  <div class="alert alert-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <?php echo $this->session->flashdata('message'); ?>
  </div>
  <?php } ?>
	<form class="form-horizontal" method="post">
  <div class="form-group">
    <label for="name" class="col-sm-3 control-label">Name</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="name" name="name" value="<?php ($userDetails['name'])?print($userDetails['name']):"";?>" placeholder="Full Name">
    </div>
  </div>
  <div class="form-group">
    <label for="username" class="col-sm-3 control-label">Username (Login Name)</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="username" name="username" value="<?php ($userDetails['username'])?print($userDetails['username']):"";?>" placeholder="User Name" readonly>
    </div>
  </div>
  <div class="form-group">
    <label for="email" class="col-sm-3 control-label">Email</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="<?php ($userDetails['email'])?print($userDetails['email']):"";?>">
    </div>
  </div>
  <div class="form-group">
    <label for="mobile" class="col-sm-3 control-label">Mobile#</label>
    <div class="col-sm-5">
      <input type="mobile" class="form-control" id="mobile" name="mobile" placeholder="Mobile Number" value="<?php ($userDetails['mobile'])?print($userDetails['mobile']):"";?>">
    </div>
  </div>
  <div class="form-group">
    <label for="password" class="col-sm-3 control-label">Password</label>
    <div class="col-sm-5">
      <a href="/users/change-password/<?php ($userDetails['id'])?print($userDetails['id']):"";?>" class="btn btn-primary">Change</a>
    </div>
  </div>
  <!--
  <div class="form-group">
    <label for="password" class="col-sm-3 control-label">Password</label>
    <div class="col-sm-5">
      <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="<?php ($userDetails['passwd'])?print($userDetails['passwd']):"";?>" >
    </div>
  </div>
  <div class="form-group">
    <label for="cpassword" class="col-sm-3 control-label">Confirm Password</label>
    <div class="col-sm-5">
      <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Confirm Password" value="<?php ($userDetails['passwd'])?print($userDetails['passwd']):"";?>">
    </div>
  </div>
  -->
  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-10">
      <div class="checkbox">
        <label>
          <input name="administrator" type="checkbox" <?php ($userDetails['is_admin'])?print("checked"):""; ?>> Administrator
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-10">
      <div class="checkbox">
        <label>
          <input name="activate" type="checkbox" <?php ($userDetails['is_active'])?print("checked"):""; ?>> Activate
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-10">
      <button type="submit" class="btn btn-primary" name="save" value="Save">Save</button>
      <a href="/users" class="btn btn-primary">Back</a>
    </div>
  </div>
</form>
</div>