<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<h3 class="page-header">Select Company</h3>
	<form class="form-horizontal" method="post">
	<div class="form-group">
		<label for="company" class="col-sm-3 control-label">Company</label>
		<div class="col-sm-5">
		    <select class="form-control" name="company" onchange="document.getElementById('company_name').value=this.options[this.selectedIndex].text">
		        <option value="">Select Company</option>        
		        <?php foreach($companies AS $company) { ?>
		        <option value="<?php echo $company['id']; ?>"><?php echo $company['name']; ?></option>
		        <?php } ?>
		    </select>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-3 col-sm-10">
	  		<button type="submit" class="btn btn-primary" name="save" value="true">Save</button>
	  		<a href="/users/companies/user/<?php echo $uid; ?>" class="btn btn-primary">Back</a>
		</div>
	</div>
</form>
</div>