<?php

$data['heading'] = '';
$data['sitename'] = '<b><font color="#3333ff">JÄÄKIEKKO</font></b>';

if( isset( $data['path'][1] ) 
 		&& $data['path'][1] != 'index'
	 	&& !isset( $data['path'][2] )
		&& count($data['pages'][$data['path'][1]]['pages']) > 0 )
{
	$data['contents'] = '<h2>' . $data['path'][1] . '</h2>';

	$dir = implode ('/', $data['path']) . '/';


	foreach ($data['pages'][$data['path'][1]]['pages'] as $name => $page )
	{
		$uri = implode ('/', $data['path']) . '/' . $name;
		$img = $page['jpg'] . '.jpg';
		$index_li[] = "<li><a href=\"$uri\"/>$name</li>";
//		To show thumbnails on index pages
//		$index_li[] = "<li><a href=\"$uri\"/><img src=\"$img\" height=\"30\"/>$name</li>";
	}
	$data['contents'] .= '<ul>' . implode($index_li) . '</ul>';
}
?>
