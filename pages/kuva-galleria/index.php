<?php
//
// Kuva-galleria controller
//
$contents_string = '<ul id="gallery">';

if ($dh = opendir($controllerdir))
{
  while (($file = readdir($dh)) !== false)
  {
	 if( $file == '.' || $file == '..' || $file == 'index.php' )
	 {
		continue;
	 }
	 $filepath = $controllerdir . '/' . $file;
	 if( filetype( $filepath ) == 'file' )
	 {
	 	$imagename_a = explode('.', $file);
	 	array_pop($imagename_a);
	 	$imagename = implode('.', $imagename_a);
	 	$files_a[$imagename] = $filepath;
	 }
  }
  closedir($dh);
}

ksort($files_a);

foreach( $files_a as $imagename => $filepath )
{
   $align = ($align == 'left') ? 'right' : 'left';
   $contents_string .= '<li class="'.$align.'">';
   $contents_string .= ($align == 'right' ? $imagename : '') . '<img src="'.$filepath.'" alt="'.$file.'"/>' . ($align == 'left' ? $imagename : '');
   $contents_string .= '</li>';
}

$contents_string .= '</ul>';

$data['contents'] = $contents_string;

$data['heading'] = '';
$data['sitename'] = '<b><font color="#33cc00">GOLF</font><font color="#3333ff">HOCKEY</font> <font color="#ff0000">KUVA-GALLERIA</font></b>';

//
// to prevent layout from rendering all image file names as submenu
unset( $data['pages'] );

?>
