<?php $menu=$this->config->config['menu'];?>
<div class="col-sm-3 col-md-2 sidebar" role="navigation">
	<ul class="nav nav-sidebar">
		<li class="<?php if($menu == 'dashboard') { ?>active<?php } ?>"><a href="/dashboard">Dashboard</a></li>
		<li class="<?php if($menu == 'product') { ?>active<?php } ?>"><a href="/product">Product</a></li>
		<li><a href="#">Order</a></li>
		<li><a href="#">Reports</a></li>
		<li class="<?php if($menu == 'users') { ?>active<?php } ?>"><a href="/users">Users</a></li>
		<li><a href="/logout">Logout</a></li>
	</ul>
</div>