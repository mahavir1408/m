<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar" aria-expanded="true" aria-controls="navbar">
	            <span class="sr-only">Toggle navigation</span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </button>
		  	<!-- The mobile navbar-toggle button can be safely removed since you do not need it in a non-responsive implementation -->
			<p class="navbar-brand"><a href="/"><span class="label label-info"><?php ($userData['company_name'])?print($userData['company_name']):""; ?></span></a>  <?php ($userData['name'])?print("Welcome!! ".$userData['name']):"";?></p>
		</div>
	</div>
</nav>
<div class="container-fluid">
	<div class="row">