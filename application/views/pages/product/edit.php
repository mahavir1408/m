<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<h3 class="page-header">Edit Product</h3>

	<form class="form-horizontal" method="post">
  <div class="form-group">
    <label for="name" class="col-sm-3 control-label">Name</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="name" name="name" value="<?php ($product['name'])?print($product['name']):"";?>" placeholder="Product Name">
    </div>
  </div>
  <div class="form-group">
    <label for="price" class="col-sm-3 control-label">Price#</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="price" name="price" value="<?php ($product['price'])?print($product['price']):0;?>" placeholder="Price">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-10">
      <button type="submit" class="btn btn-primary">Save</button>
      <a href="/product" class="btn btn-primary">Back</a>
    </div>
  </div>
</form>
</div>