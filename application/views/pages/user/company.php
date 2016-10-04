<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<h3 class="page-header">User Companies</h3>
	<?php if($this->session->flashdata('success')){ ?>
	<div class="alert alert-success alert-dismissible" role="alert">
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  <?php echo $this->session->flashdata('message'); ?>
	</div>
	<?php } ?>
	<div class="panel panel-default">
		<!-- Default panel contents -->
		<div class="panel-heading"><a class="btn btn-primary pull-right" href="/users/companies/add/<?php echo $uid; ?>" role="button">Add Company</a><div class="clearfix"></div></div>
		<?php if(!empty($companies)) { ?>
		<!-- Table -->
		<table class="table table-bordered table-hover">
		<thead>
		<tr>
			<th>Sr. No.</th>
			<th>Name</th>
			<th>Action</th>
		</tr>
		</thead>
		<tbody>
		<?php $serial = 1; ?>
		<?php foreach($companies AS $v){ ?>		
		<tr>
			<th scope="row"><?php echo $serial++; ?></th>
			<td><?php echo $v['name'];?></td> 
			<td><a title="Delete" onclick="return confirm('Are you sure you want to remove <?php echo $v['name'];?>?')" href="/users/company/delete/<?php echo $v['id'];?>/<?php echo $uid; ?>"><span class="glyphicon glyphicon-remove-circle"></span></a></td>
		</tr>
		<?php } ?>
		</tbody>
		</table>
		<div class="panel-footer"><div class="pull-right"><a href="/users" class="btn btn-primary">Back</a></div><div class="clearfix"></div></div>
		<?php } else { ?>
		<div class="panel-footer"> <div class="alert alert-info" role="alert"><strong>No records available!!</strong></div><div class="pull-right"><a href="/users" class="btn btn-primary">Back</a></div><div class="clearfix"></div> </div>
		<?php } ?>
	</div>
</div>