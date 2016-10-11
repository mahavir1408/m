<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<h3 class="page-header">Invoice Details</h3>
	<div class="panel panel-default">
		<!-- Default panel contents -->
		<div class="panel-heading">
			<a class="btn btn-primary pull-right" href="/orders" role="button">Back</a><div class="clearfix"></div>
		</div>
		<?php if(!empty($invoiceDetails)) { ?>
		<!-- Table -->
		<table class="table table-bordered table-hover">
		<thead>
		<tr>
			<th>Sr. No.</th>
			<th>Product</th>
			<th>Quantity</th>
			<th>Price</th>
			<th>Amount</th>
		</tr>
		</thead>
		<tbody>
		<?php 
			$serial = 1;
			$total_amount = 0;
		?>
		<?php foreach($invoiceDetails AS $k => $v){ ?>		
		<tr>
			<th scope="row"><?php echo $serial++; ?></th>
			<td><?php echo $v['product'];?></td>
			<td>Rs. <?php echo $v['quantity'];?></td>
			<td><?php echo $v['price'];?></td>
			<td><?php echo $v['amount'];?></td>
		</tr>
		<?php
			$total_amount = $total_amount+$v['amount'];
		?>
		<?php } ?>
		<tr><td colspan='4' align='right'>Total Amount:</td><td align='left'><?php echo $total_amount; ?></td></tr>
		</tbody>
		</table>
		<?php } else { ?>
		<div class="panel-footer"> <div class="alert alert-info" role="alert"><strong>No records available!!</strong></div> </div>
		<?php } ?>
	</div>
</div>