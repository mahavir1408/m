$(document).ready(function(){

	
	var html = "<form name='invoice_form' id='invoice_form' method='post'>";
	html += "<div class='panel panel-info'>";
	html += "<div class='panel-heading'>";
	html += "<div class='row'>";
	html += "<div class='col-md-4'>";
	html += "<div class='panel panel-primary'>";
	html += "<div class='panel-heading'><h3 class='panel-title'>From:</h3></div>";
	html += "<div class='panel-body'>";
	html += "<input type='text' name='company_name' id='company_name' class='form-control' placeholder='Company Name' readonly /><hr class='invoice-hr'/>";
	html += "<input type='text' name='company_address' id='company_address' class='form-control' placeholder='Company Address' readonly /><hr class='invoice-hr'/>";
	html += "</div>";
	html += "</div>";
	html += "</div>";
	html += "<div class='col-md-4'>";
	html += "<div class='panel panel-primary'>";
	html += "<div class='panel-heading'><h3 class='panel-title'>To:</h3></div>";
	html += "<div class='panel-body'>";
	html += "<input type='text' name='customer_name' id='customer_name' class='form-control' placeholder='Customer Name' /><hr class='invoice-hr'/>";
	html += "<input type='text' name='customer_mobile' id='customer_mobile' class='form-control' placeholder='Customer Mobile' /><hr class='invoice-hr'/>";
	html += "</div>";
	html += "</div>";
	html += "</div>";
	html += "<div class='col-md-4'>";
	html += "<div class='panel panel-primary'>";
	html += "<div class='panel-heading'><h3 class='panel-title'>Invoice Information</h3></div>";
	html += "<div class='panel-body'>";
	html += "<strong>Bill No#</strong><input type='text' name='invoice_number' id='invoice_number' class='form-control' readonly /><hr class='invoice-hr'/>";
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
	html += "<tr>";
	html += "<td colspan='3'><button name='add' id='add' class='btn btn-primary'>Add</button><strong style='float:right;'>Total:</strong></td>";
	html += "<td><input type='text' id='total_quantity' name='total_quantity' value='0' class='form-control' /></td>";
	html += "<td colspan='2'><input type='text' id='total_amount' class='total-amount form-control' name='total_amount' value='0' /></td>";
	html += "</tr>";	
	html += "</tbody>";
	html += "</table>";
	//html += "<div><button class='btn btn-primary' name='save' id='save' value='save'>Save & Print</button></div>";
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
	    $(".total-amount").val(sum);
	};

	var printOut = function(content){
	    var frame1 = document.createElement('iframe');
	    frame1.name = "frame1";
	    frame1.style.position = "absolute";
	    frame1.style.top = "-1000000px";
	    document.body.appendChild(frame1);
	    var frameDoc = frame1.contentWindow ? frame1.contentWindow : frame1.contentDocument.document ? frame1.contentDocument.document : frame1.contentDocument;
	    frameDoc.document.open();
	    frameDoc.document.write('<html><head><title>'+$("#company_name").val()+' | Invoice# '+$("#invoice_number").val()+'</title>');
	    frameDoc.document.write('</head><body>');
	    frameDoc.document.write(content);
	    frameDoc.document.write('</body></html>');
	    frameDoc.document.close();
	    setTimeout(function () {
	        window.frames["frame1"].focus();
	        window.frames["frame1"].print();
	        document.body.removeChild(frame1);
	    }, 500);
	    return false;
	};

	var generatePrint = function(){
		var momentNow = moment();
	    var bill_dt = momentNow.format('DD MMM YYYY') + ', ' + momentNow.format('dddd').substring(0,3).toUpperCase() + ', ' + momentNow.format('hh:mm:ss A');
		var border_bottom = "style='border-bottom: 0.1em dotted;'";
		var border_top = "style='border-top: 0.1em dotted;'";
		var printHtml = "<table border='0' width='100%'>";
		printHtml += "<tr><th colspan='5' align='center' "+border_bottom+">"+$("#company_name").val()+"</th></tr>";
		printHtml += "<tr><td colspan='3' align='left'><strong>Bill No#</strong> "+$("#invoice_number").val()+" </td><td colspan='2' align='right'><strong>Date/Time:</strong> "+bill_dt+"</td></tr>";
		printHtml += "<tr><td colspan='5' align='left' "+border_bottom+"><strong>Name: </strong> "+$("#customer_name").val()+"</td></tr>";
		printHtml += "<tr><th "+border_bottom+">Sr. No.</th><th "+border_bottom+">Item</th><th "+border_bottom+">Price</th><th "+border_bottom+">Quantity</th><th "+border_bottom+">Amount</th></tr>";
		
		
		$('.selectpicker').each(function(i){
			var rowNumber = $(this).data('row');
			var item_name = $(this).find('option:selected').text();
			var item_id = $(this).find('option:selected').val();
			var item_quantity = $("#quantity"+rowNumber+"").val();
			var item_price = $("#price"+rowNumber+"").val();
			var item_amount = $("#amount"+rowNumber+"").val();
			var printHtmlRow = "";
			if(item_quantity==0){
				alert("Please add quantity for "+item_name+"!!");
				return false;
			}
			
			i++;

			printHtmlRow = "<tr><td align='center'>"+i+"</td><td align='center'>"+item_name+"</td><td align='center'>"+item_price+"</td><td align='center'>"+item_quantity+"</td><td align='center'>"+item_amount+"</td></tr>";
			printHtml += printHtmlRow;
		});		
		var total_quantity = $("#total_quantity").val();
		var total_amount = $("#total_amount").val();
		printHtml += "<tr><th colspan='3' "+border_top+">Total:</th><th "+border_top+">"+total_quantity+"</th><th "+border_top+">"+total_amount+"</th></tr>";
		printHtml += "</table>";
		printOut(printHtml);
		$("#invoice_form").submit(function(e){return false;});	
	};

	var saveAndPrint = function(){
		$("#invoice_form").submit(function(e){return false;});
		var jsonObj = {};
		$('.selectpicker').each(function(i){
			var rowNumber = $(this).data('row');
			var item_name = $(this).find('option:selected').text();
			var item_id = $(this).find('option:selected').val();
			var item_quantity = $("#quantity"+rowNumber+"").val();
			var item_price = $("#price"+rowNumber+"").val();
			var item_amount = $("#amount"+rowNumber+"").val();
			jsonObj[i] = {item_id:item_id,item_name:item_name,quantity:item_quantity,price:item_price,amount:item_amount};
		});
		$.ajax({
			data: {items:JSON.stringify(jsonObj)},
			url: "/invoice/save",
			method:'post',
			success:function(data){
				generatePrint();
				constructInvoicePage();
				console.log("data:");
				console.log(data);
			}
		});
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
		var price 	= $("<td><input type='text' name='price[]' class='form-control'  id='price"+rowCount+"' value='0' readonly /></td>");
		var qty 	= $("<td><input type='text' name='quantity[]' data-row='"+rowCount+"' class='form-control quantity-class' id='quantity"+rowCount+"' value='0' onkeyup='' /></td>");
		var amt 	= $("<td><input type='text' name='amount[]' data-row='"+rowCount+"' class='form-control amount-class' id='amount"+rowCount+"' value='0' readonly /></td>");
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
	        $('#datetime').html(momentNow.format('DD MMM YYYY') + ', ' + momentNow.format('dddd').substring(0,3).toUpperCase() + ', ' + momentNow.format('hh:mm:ss A'));
	     }, 100);
		//$("#invoice_form").submit(function(e){return false;});
		$.ajax({
			url:"/invoice/construct-invoice",
			success:function(data){
				var response = JSON.parse(data);			
				$("#invoice_number").val(response.invoice_number);
				$("#company_name").val(response.company_details.name);
				$("#company_address").val(response.company_details.address);
				var input = $('<input>');
				input.attr('type','hidden');
				input.attr('name','product_list');
				input.attr('id','product_list');
				input.data('product_list',response.product_list);
				$("#invoice").append(input);
			}
		});
		$("#invoice_block").after("<div><button class='btn btn-primary' name='save' id='save' value='save'>Save & Print</button></div>");
		$("#save").on("click",function(){saveAndPrint();});
		$("#add").on("click",function(){addRow();return false;});
	};
	constructInvoicePage();

});