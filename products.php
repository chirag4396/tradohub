<?php include 'config.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Products</title>
	<style type="text/css">
	.product{
		width: 30%;
		border: 1px dashed #a4a4a4;
		padding: 10px;
		text-align: center;
		float: left;
		margin: 0.6%;
	}
	img	{
		height: 200px;
		object-fit: contain;
		width: 200px;
	}
	.filter {
		width: 15%;
		float: left;
	}
	.products {
		width: 85%;
		float: left;
	}
</style>
</head>
<body>
	<div class = "filter">
		<form id = "filterForm">
			<fieldset>
				<legend>Sizes:</legend>
				<?php 
				$resSize = $con->query('select * from sizes');
				while ($size = $resSize->fetch_assoc()) {
					echo '<div><input type="checkbox" name="sizes[]" value = "'.$size['size_id'].'">'. $size['size_title'].'</div>';
				}
				?>
			</fieldset>
			
			<fieldset>
				<legend>Colors:</legend>				
				<?php
				$resColor = $con->query('select * from colors');
				while ($color = $resColor->fetch_assoc()) {
					echo '<div><input type="checkbox" name="colors[]" value = "'.$color['color_id'].'">'. $color['color_title'].'</div>';
				}
				?>
			</fieldset>

			<fieldset>
				<legend>Categories:</legend>
				<?php
				$resCategory = $con->query('select * from categories');
				while ($category = $resCategory->fetch_assoc()) {
					echo '<div><input type="checkbox" name="categories[]" value = "'.$category['cat_id'].'">'. $category['cat_title'].'</div>';
				}
				?>
			</fieldset>
		</form>
	</div>
	<div class = "products" id = "productsBox"></div>
	<script type="text/javascript" src = "js/jquery.min.js"></script>
	<script type="text/javascript">
		function getProducts() {
			$('#productsBox').html('<h2>Loading...</h2>');			
			var fd = new FormData($('#filterForm')[0]);
			$.ajax({
				url : 'req/products.php',
				type: 'post',
				data : fd,
				processData : false,
				contentType : false,
				success : function(data){
					$('#productsBox').html(data);
				}
			});
		}
		getProducts();

		$('input[type="checkbox"]').on({
			'change' : function(){
				getProducts();
			}
		});
	</script>
</body>
</html>