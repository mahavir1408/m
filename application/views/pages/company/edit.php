<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<h3 class="page-header">Edit Company</h3>
	<form class="form-horizontal" method="post">
	<div class="form-group">
		<label for="company" class="col-sm-3 control-label">Company</label>
		<div class="col-sm-5">
		  <input type="text" class="form-control" id="company" name="company" value="<?php ($company['name'])?print($company['name']):"";?>" placeholder="Company Name">
		</div>
	</div>
  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-10">
      <div class="checkbox">
        <label>
          <input name="activate" type="checkbox" <?php ($company['is_active'])?print("checked"):""; ?>> Activate
        </label>
      </div>
    </div>
  </div>
	<div class="form-group">
		<div class="col-sm-offset-3 col-sm-10">
		  <button type="submit" class="btn btn-primary" name="save" value="save">Save</button>
		  <a href="/company" class="btn btn-primary">Back</a>
		</div>
	</div>
</form>
</div>