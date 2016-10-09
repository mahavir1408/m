$(document).ready(function(){

	
	var html = "<form name='invoice_form' id='invoice_form' method='post'>";
	html += "<div class='panel panel-info'>";
	html += "<div class='panel-heading'>";
	html += "<div class='row'>";
	html += "<div class='col-md-4'>";
	html += "<div class='panel panel-primary'>";
	html += "<div class='panel-heading'><h3 class='panel-title'>From: <span id='company_name'></span></h3></div>";
	html += "<div class='panel-body'><span id='company_address'></div>";
	html += "</div>";
	html += "</div>";
	html += "<div class='col-md-4'></div>";
	html += "<div class='col-md-4'>";
	html += "<div class='panel panel-primary'>";
	html += "<div class='panel-heading'><h3 class='panel-title'>Invoice Information</h3></div>";
	html += "<div class='panel-body'>";
	html += "<strong>Invoice#</strong><input type='text' name='invoice_number' id='invoice_number' class='form-control' readonly /><hr class='invoice-hr'/>";
	html += "<strong>Total:</strong> Rs. <input type='text' id='header_total_amount' class='total-amount form-control' name='header_total_amount' value='0' readonly /></span><hr class='invoice-hr'/><strong>Date:</strong> <span id='datetime'></span></div>";
	html += "</div>";
	html += "</div>";
	html += "</div>";
	html += "</div>";
	html += "<div class='panel-body'>";
	html += "<table class='table table-bordered' id='invoice_block'>";
	html += "<thead>"; 
	html += "<tr>";
	html += "<th>Sr. No</th>";
	html += "<th>Item</th>";
	html += "<th>Price</th>";
	html += "<th>Quantity</th>";
	html += "<th>Amount</th>";
	html += "<th>Action</th>";
	html += "</tr>"; 
	html += "</thead>";
	html += "<tbody>";
	//html += "<tr><td>1</td><td><input type='text' name='item[]' class='form-control item' /></td><td>1</td><td>10</td><td>10</td></tr>";
	html += "<tr>";
	html += "<td colspan='3'><button name='add' id='add' class='btn btn-primary'>Add</button><strong style='float:right;'>Total:</strong></td>";
	html += "<td><input type='text' id='total_quantity' name='total_quantity' value='0' class='form-control' /></td>";
	html += "<td colspan='2'><input type='text' id='total_amount' class='total-amount form-control' name='total_amount' value='0' /></td>";
	html += "</tr>";	
	html += "</tbody>";
	html += "</table>";
	html += "<button class='btn btn-primary'>Save & Print</button>";
	html += "</div>";
	html += "</div>";
	html += "</form>";
	

	var updateQuantity = function(){
		var sum = 0;
	    $('.quantity-class').each(function() {
	        sum += Number($(this).val());
	    });
	    $("#total_quantity").val(sum);
	};

	var updateTotalAmount = function(){
		var sum = 0;
	    $('.amount-class').each(function() {
	        sum += Number($(this).val());
	    });
	    //$("#total_amount").val(sum);
	    $(".total-amount").val(sum);
	};

	

	var addRow = function(){

		var table = $("#invoice_block");
		var rowCount = $("#invoice_block>tbody>tr").length;
		var items = $("#product_list").data('product_list');
		var sel = $('<select>');
		sel.attr('name','items[]');
		sel.attr('id','items'+rowCount+'');
		sel.attr('data-live-search',true);
		sel.attr('data-row',rowCount);
		sel.attr('class','selectpicker');
		sel.attr('title','Select Item');
		$(items).each(function() {
		 	sel.append($("<option data-price='"+this.price+"'>").attr('value',this.id).text(this.name));
		});
	
		var row 	= $("<tr></tr>");
		var sr_no 	= $("<td>"+rowCount+"</td>");
		var item 	= $("<td></td>").html(sel);
		var price 	= $("<td><input type='text' name='price[]' id='price"+rowCount+"' class='form-control' value='0' readonly /></td>");
		var qty 	= $("<td><input type='text' name='quantity[]' data-row='"+rowCount+"' class='form-control quantity-class' id='quantity"+rowCount+"' value='0' onkeyup='' /></td>");
		var amt 	= $("<td><input type='text' name='amount[]' id='amount"+rowCount+"' class='form-control amount-class' value='0' readonly /></td>");
		var remove 	= $("<td><button name='remove[]' data-row='"+rowCount+"' class='remove-class btn btn-primary' id='remove"+rowCount+"'>Remove</button></td>");
		row.append(sr_no,item,price,qty,amt,remove)
		row.insertBefore('#invoice_block > tbody > tr:last');

		$('#quantity'+rowCount+'').on('change',function(){
			var row = $(this).data('row');
			var row_amount = 0;
			row_amount = $("#price"+row+"").val() * $('#quantity'+row+'').val();
			$('#amount'+row+'').val(row_amount);
			updateQuantity();
			updateTotalAmount();
		});

		
		$('.remove-class').on('click',function(){
			var row = $(this).data('row');
			$(this).closest("tr").remove();
			updateQuantity();
			updateTotalAmount();
		});
		rowCount++;
		$('select').selectpicker();
		$('select').on('change',function(){
			var row = $(this).data('row');
			var selected = $(this).find('option:selected');
			$("#price"+row+"").val(selected.data('price'));
		});
	};

	var constructInvoicePage = function(){
		$("#invoice").html(html);
		var interval = setInterval(function() {
		        var momentNow = moment();
		        $('#datetime').html(momentNow.format('DD MMM YYYY') + ', '
		                            + momentNow.format('dddd')
		                             .substring(0,3).toUpperCase() + ', ' + momentNow.format('hh:mm:ss A'));
		        
		    }, 100);
		//$("#invoice_form").submit(function(e){return false;});
		$.ajax({
			url:"/invoice/construct-invoice",
			success:function(data){
				var response = JSON.parse(data);			
				$("#invoice_number").val(response.invoice_number);
				$("#company_name").html(response.company_details.name);
				$("#company_address").html(response.company_details.address);
				var input = $('<input>');
				input.attr('type','hidden');
				input.attr('name','product_list');
				input.attr('id','product_list');
				input.data('product_list',response.product_list);
				$("#invoice").append(input);
				//$("#invoice").append("<div><button>Print</button></div>");
			}
		});
		$("#add").on("click",function(){addRow();return false;});
	};
	constructInvoicePage();
});