<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Datatable CRUD Example using Codeigniter, MySQL, AJAX</title>
	<!--[if IE]> <script> (function() { var html5 = ("abbr,article,aside,audio,canvas,datalist,details," + "figure,footer,header,hgroup,mark,menu,meter,nav,output," + "progress,section,time,video").split(','); for (var i = 0; i < html5.length; i++) { document.createElement(html5[i]); } try { document.execCommand('BackgroundImageCache', false, true); } catch(e) {} })(); </script> <![endif]-->
	<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery.dataTables.min.css"/>
	<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery.modal.min.css"/>
	<script type= 'text/javascript' src="<?php echo base_url(); ?>assets/js/jquery-1.11.3.min.js"></script>
	<script type= 'text/javascript' src="<?php echo base_url(); ?>assets/js/jquery.modal.min.js"></script>
	<script type= 'text/javascript' src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
	<script type= 'text/javascript'>
		$(document).ready(function () {
			$('#product-grid').DataTable({
				"processing": true,
				"serverSide": true,
				"ajax": "http://localhost/ci3_datatable/index.php/datatable/get_products"
			});
			
			$(document).delegate('.delete', 'click', function() { 
				if (confirm('Do you really want to delete record?')) {
					var id = $(this).attr('id');
					var parent = $(this).parent().parent();
					$.ajax({
						type: "POST",
						url: "http://localhost/ci3_datatable/index.php/datatable/delete_product",
						data: 'id=' + id,
						cache: false,
						success: function() {
							parent.fadeOut('slow', function() {
								$(this).remove();
							});
						},
						error: function() {
							$('#err').html('<span style=\'color:red; font-weight: bold; font-size: 30px;\'>Error deleting record').fadeIn().fadeOut(4000, function() {
								$(this).remove();
							});
						}
					});
				}
			});
			
			$(document).delegate('.edit', 'click', function() {
				var parent = $(this).parent().parent();
				
				var id = parent.children("td:nth-child(1)");
				var name = parent.children("td:nth-child(2)");
				var price = parent.children("td:nth-child(3)");
				var sale_price = parent.children("td:nth-child(4)");
				var sale_count = parent.children("td:nth-child(5)");
				var sale_date = parent.children("td:nth-child(6)");
				var buttons = parent.children("td:nth-child(7)");
				
				name.html("<input type='text' id='txtName' value='"+name.html()+"'/>");
				price.html("<input type='text' id='txtPrice' value='"+price.html()+"'/>");
				sale_price.html("<input type='text' id='txtSalePrice' value='"+sale_price.html()+"'/>");
				sale_count.html("<input type='text' id='txtSaleCount' value='"+sale_count.html()+"'/>");
				sale_date.html("<input type='text' id='txtSaleDate' value='" + sale_date.html()+"'/>");
				buttons.html("<button id='save'>Save</button>&nbsp;&nbsp;<button class='delete' id='" + id.html() + "'>Delete</button>");
			});
			
			$(document).delegate('#save', 'click', function() {
				var parent = $(this).parent().parent();
				
				var id = parent.children("td:nth-child(1)");
				var name = parent.children("td:nth-child(2)");
				var price = parent.children("td:nth-child(3)");
				var sale_price = parent.children("td:nth-child(4)");
				var sale_count = parent.children("td:nth-child(5)");
				var sale_date = parent.children("td:nth-child(6)");
				var buttons = parent.children("td:nth-child(7)");
				
				$.ajax({
					type: "POST",
					url: "http://localhost/ci3_datatable/index.php/datatable/update_product",
					data: 'id=' + id.html() + '&name=' + name.children("input[type=text]").val() + '&price=' + price.children("input[type=text]").val() + '&sale_price=' + sale_price.children("input[type=text]").val() + '&sale_count=' + sale_count.children("input[type=text]").val() + '&sale_date=' + sale_date.children("input[type=text]").val(),
					cache: false,
					success: function() {
						name.html(name.children("input[type=text]").val());
						price.html(price.children("input[type=text]").val());
						sale_price.html(sale_price.children("input[type=text]").val());
						sale_count.html(sale_count.children("input[type=text]").val());
						sale_date.html(sale_date.children("input[type=text]").val());
						buttons.html("<button class='edit' id='" + id.html() + "'>Edit</button>&nbsp;&nbsp;<button class='delete' id='" + id.html() + "'>Delete</button>");
					},
					error: function() {
						$('#err').html('<span style=\'color:red; font-weight: bold; font-size: 30px;\'>Error updating record').fadeIn().fadeOut(4000, function() {
							$(this).remove();
						});
					}
				});
			});
			
			$(document).delegate('#addNew', 'click', function(event) {
				event.preventDefault();
				
				var str = $('#add').serialize();
				
				$.ajax({
					type: "POST",
					url: "http://localhost/ci3_datatable/index.php/datatable/add_product",
					data: str,
					cache: false,
					success: function() {
						$("#msgAdd").html( "<span style='color: green'>Product added successfully</span>" );
					},
					error: function() {
						$("#msgAdd").html( "<span style='color: red'>Error adding a new product</span>" );
					}
				});
			});
		});
	</script>
	
	<style>
		.modal p { margin: 1em 0; }
		
		.add_form.modal {
		  border-radius: 0;
		  line-height: 18px;
		  padding: 0;
		  font-family: "Lucida Grande", Verdana, sans-serif;
		}

		.add_form h3 {
		  margin: 0;
		  padding: 10px;
		  color: #fff;
		  font-size: 14px;
		  background: -moz-linear-gradient(top, #2e5764, #1e3d47);
		  background: -webkit-gradient(linear,left bottom,left top,color-stop(0, #1e3d47),color-stop(1, #2e5764));
		}

		.add_form.modal p { padding: 20px 30px; border-bottom: 1px solid #ddd; margin: 0;
		  background: -webkit-gradient(linear,left bottom,left top,color-stop(0, #eee),color-stop(1, #fff));
		  overflow: hidden;
		}
		.add_form.modal p:last-child { border: none; }
		.add_form.modal p label { float: left; font-weight: bold; color: #333; font-size: 13px; width: 110px; line-height: 22px; }
		.add_form.modal p input[type="text"],
		.add_form.modal p input[type="submit"]		{
		  font: normal 12px/18px "Lucida Grande", Verdana;
		  padding: 3px;
		  border: 1px solid #ddd;
		  width: 200px;
		}
		
		#msgAdd {
		  margin: 10px;
		  padding: 30px;
		  color: #fff;
		  font-size: 18px;
		  font-weight: bold;
		  background: -moz-linear-gradient(top, #2e5764, #1e3d47);
		  background: -webkit-gradient(linear,left bottom,left top,color-stop(0, #1e3d47),color-stop(1, #2e5764));
		}
	</style>
</head>
<body>
	<p id='err'/>
	<p><a class='btn' href="#add" rel="modal:open">Add New Product</a></p>
	<table id="product-grid" class="display" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>Id</th>
				<th>Name</th>
				<th>Price</th>
				<th>Sale Price</th>
				<th>Sale Count</th>
				<th>Sale Date</th>
				<th>Actions</th>
			</tr>
		</thead>
	</table>
	
	<form id="add" action="#" class="add_form modal" style="display:none;">
		<div id='msgAdd'/>
		<h3>Add a new product</h3>
		<p>
			<label>Name</label>
			<input type="text" name="name">
		</p>
		<p>
			<label>Price</label>
			<input type="text" name="price">
		</p>
		<p>
			<label>Sale Price</label>
			<input type="text" name="sale_price">
		</p>
		<p>
			<label>Sale Count</label>
			<input type="text" name="sale_count">
		</p>
		<p>
			<label>Sale Date</label>
			<input type="text" name="sale_date">
		</p>
		<p>
			<input type="submit" id="addNew" value="Submit">
		</p>
	</form>
</body>
</html>