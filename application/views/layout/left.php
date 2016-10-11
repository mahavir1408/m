<?php $menu=$this->config->config['menu'];?>
<div class="col-sm-3 col-md-2 sidebar" role="navigation">
	<ul class="nav nav-sidebar">
		<li class="<?php if($menu == 'dashboard') { ?>active<?php } ?>"><a href="/dashboard">Dashboard</a></li>
		<li class="<?php if($menu == 'product') { ?>active<?php } ?>"><a href="/product">Product</a></li>
		<?php if($userData['is_admin']){ ?>
		<li class="<?php if($menu == 'company') { ?>active<?php } ?>"><a href="/company">Company</a></li>
		<li class="<?php if($menu == 'user') { ?>active<?php } ?>"><a href="/users">Users</a></li>
		<?php } ?>
		<li class="<?php if($menu == 'orders') { ?>active<?php } ?>"><a href="/orders">Orders</a></li>
		<li><a href="/logout">Logout</a></li>
	</ul>
</div>