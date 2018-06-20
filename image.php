<!DOCTYPE html>
<html>
<head>
	<title>Image Upload & crop</title>
</head>
<body>
	<form id = "imageForm" enctype="multipart/form-data">
		<div>		
			<input type="file" name="image">
			<hr>
		</div>
		<div>
			<input type="radio" name="type" value="compress"> Compress
			<input type="radio" name="type" value="crop"> Crop
			<input type="radio" name="type" value="resize"> Resize
			<hr>
			<div id = "compress" style="display: none;">
				<label>Percent%:</label>
				<input type="text" name="percent">
				<hr>
			</div>
			<div id = "crop" style="display: none;">
				<label>Set Crop Resolution:</label>
				<input type="text" name="width"> x
				<input type="text" name="height">
				<hr>
			</div>
			<div id = "resize" style="display: none;">
				<label>Resize to :</label>
				<input type="text" name="rwidth"> x
				<input type="text" name="rheight">
				<hr>
			</div>
		</div>
		<input type="submit">
	</form>
	<div id = "imageBox">
	</div>
	<script type="text/javascript" src = "js/jquery.min.js"></script>
	<script type="text/javascript">
		function openTab(id) {
			var tabs = ['#compress', '#crop', '#resize'];
			$(id).show();
			newIds = jQuery.grep(tabs, function(value) {
				return value != id;
			});
			$(newIds.join(', ')).hide();			
		}

		$('input[type="radio"]').on({
			'change' : function(){
				openTab('#'+this.value);
			}
		});
		$('#imageForm').on({
			'submit' : function(e){
				$('#imageBox').html('Loading..');				
				e.preventDefault();
				var fd = new FormData(this);
				$.ajax({
					url : 'req/upload.php',
					type: 'post',
					data : fd,
					processData : false,
					contentType : false,
					dataType : 'json',
					success : function(data){
						var d = [];
						var t = ['Original', 'Output'];
						$.each(data, function(k,v){							
							d.push('<h3>'+t[k]+'</h3><img src="'+v.replace('../', '')+'">');							
						});
						$('#imageBox').html(d);
					}
				});
			}
		});
	</script>
</body>
</html>