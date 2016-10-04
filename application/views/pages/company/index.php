<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<h3 class="page-header">Companies</h3>
	<?php if($this->session->flashdata('success')){ ?>
	<div class="alert alert-success alert-dismissible" role="alert">
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  <?php echo $this->session->flashdata('message'); ?>
	</div>
	<?php } ?>
	<div class="panel panel-default">
		<!-- Default panel contents -->
		<div class="panel-heading"><a class="btn btn-primary pull-right" href="/company/add" role="button">Add Company</a><div class="clearfix"></div></div>
		<?php if(!empty($companies)) { ?>
		<!-- Table -->
		<table class="table table-bordered table-hover">
		<thead>
		<tr>
			<th>Sr. No.</th>
			<th>Name</th>
			<th>Status</th>
			<th>Action</th>
		</tr>
		</thead>
		<tbody>
		<?php $serial = ($pageNumber *  ($this->config->item('pagination')['per_page'])) + 1; ?>
		<?php foreach($companies AS $k => $v){ ?>		
		<tr>
			<th scope="row"><?php echo $serial++; ?></th>
			<td><?php echo $v['name'];?></td> 
			<td><?php ($v['is_active'])?print("Active"):print("Inactive");?></td>
			<td><a href="/company/edit/<?php echo $v['id'];?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
		</tr>
		<?php } ?>
		</tbody>
		</table>
		<div class="panel-footer"><div class="pull-right"><?php ($pagination)?print($pagination):""; ?></div><div class="clearfix"></div></div>
		<?php } else { ?>
		<div class="panel-footer"> <div class="alert alert-info" role="alert"><strong>No records available!!</strong></div> </div>
		<?php } ?>
	</div>
</div>