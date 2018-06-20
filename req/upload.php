<?php
function createImage($file) {	
	$exploding = explode(".",$file);
	$ext = end($exploding);
	
	switch($ext){
		case "png":
		$src = imagecreatefrompng($file);
		break;
		case "jpeg":
		case "jpg":
		$src = imagecreatefromjpeg($file);
		break;
		default:
		$src = imagecreatefromjpeg($file);
		break;
	}

	return $src;
}

function resize_image($file, $w, $h, $crop=false) {
	$e = explode('/',$file);

	$newPath = str_replace(end($e), '', $file).'resizes/'.end($e);

	list($width, $height) = getimagesize($file);
	$r = $width / $height;
	if ($crop) {
		if ($width > $height) {
			$width = ceil($width-($width*abs($r-$w/$h)));
		} else {
			$height = ceil($height-($height*abs($r-$w/$h)));
		}
		$newwidth = $w;
		$newheight = $h;
	} else {
		if ($w/$h > $r) {
			$newwidth = $h*$r;
			$newheight = $h;
		} else {
			$newheight = $w/$r;
			$newwidth = $w;
		}
	}      

	$dst = imagecreatetruecolor($newwidth, $newheight);
	imagecopyresampled($dst, createImage($file) , 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
	
	$exploding = explode(".",$file);
	$ext = end($exploding);

	switch($ext){
		case "png":
		imagepng($dst, $newPath);
		break;
		case "jpeg":
		case "jpg":
		imagejpeg($dst, $newPath);
		break;
		default:
		imagejpeg($dst, $newPath);
		break;
	}
	return $newPath;
}

function compressImage($image, $quality) {

	$sourceImage = $image;
	$e = explode('/',$image);

	$targetImage = str_replace(end($e), '', $image).'compressed/'.end($e);
	// $targetImage = $image;

	list($maxWidth, $maxHeight, $type, $attr) = getimagesize($image);
	
	if (!$image = @imagecreatefromjpeg($sourceImage)){
		return false;
	}

	list($origWidth, $origHeight) = getimagesize($sourceImage);

	if ($maxWidth == 0){
		$maxWidth  = $origWidth;
	}

	if ($maxHeight == 0){
		$maxHeight = $origHeight;
	}

	$widthRatio = $maxWidth / $origWidth;
	$heightRatio = $maxHeight / $origHeight;

	$ratio = min($widthRatio, $heightRatio);

	$dataewWidth  = (int)$origWidth  * $ratio;
	$dataewHeight = (int)$origHeight * $ratio;

	$dataewImage = imagecreatetruecolor($dataewWidth, $dataewHeight);
	imagecopyresampled($dataewImage, $image, 0, 0, 0, 0, $dataewWidth, $dataewHeight, $origWidth, $origHeight);
	imageinterlace($image, 1);
	imagejpeg($dataewImage, $targetImage, $quality);

	imagedestroy($image);
	imagedestroy($dataewImage);

	return $targetImage;
}

function cropImage($file, $w, $h) {
	$im = createImage($file);
	
	$im2 = imagecrop($im, ['x' => 0, 'y' => 0, 'width' => $w, 'height' => $h]);
	$title = rand(1,9999).'-'.$w.'x'.$h.'.png';
	$path = '../images/cropped/';
	if ($im2 !== FALSE) {
		imagepng($im2, $path.$title);
		imagedestroy($im2);
	}
	imagedestroy($im);

	return $path.$title;
}

if(isset($_FILES['image'])){	
	$filename = $_FILES['image']['name'];
	$file_tmp = $_FILES['image']['tmp_name'];
	$exe = explode(".", $filename);
	$title = rand(1,9999).'.'.end($exe);
	$path = '../images/';
	
	move_uploaded_file($file_tmp, $path.$title);
	$images[] = $path.$title;

	switch ($_POST['type']) {
		case 'resize':		
		$images[] = resize_image($images[0], $_POST['rwidth'], $_POST['rheight']);
		break;		
		case 'compress':
		$images[] = compressImage($images[0], $_POST['percent']);
		break;
		default:
		$images[] = cropImage($images[0], $_POST['width'], $_POST['height']);
		break;
	}

	echo json_encode($images);
}