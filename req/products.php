<?php
include '../config.php';


$sql = 'select * from products join sizes on sizes.size_id = products.pro_size join categories on categories.cat_id = products.pro_category join colors on colors.color_id = products.pro_color';

if(isset($_POST['sizes'])){
	$where[] = ' pro_size in ('.implode(',', $_POST['sizes']).')';
}
if(isset($_POST['colors'])){
	$where[] = ' pro_color in ('.implode(',', $_POST['colors']).')';
}
if(isset($_POST['categories'])){
	$where[] = ' pro_category in ('.implode(',', $_POST['categories']).')';
}

if (isset($where)) {	
	$sql .= ' where '.implode(' and ', $where);
}
// echo $sql;
$res = $con->query($sql);
$data = '';
if($res->num_rows){
	
	while ($row = $res->fetch_assoc()) {
		$data .= '<div class="product">'
		.'<img src="'.$row['pro_image'].'" width="200">'
		.'<h3>'.$row['pro_title'].'</h3>'
		.'<div>'.$row['size_title'].' | '.$row['color_title'].' | '.$row['cat_title'].'</div>'
		.'</div>';
	}

	echo $data;
}else{
	echo 'No Product Found';
}