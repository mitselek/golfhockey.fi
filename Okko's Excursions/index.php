<?php
 
# Lets collect path elements.
# TODO: path elements - array $data['path'] - should be 
# initialsed from address-line
if (isset ($_GET['section'])) $data['path'][] = $_GET['section'];
if (isset ($_GET['page'])) $data['path'][] = $_GET['page'];
if (isset ($_GET['page2'])) $data['path'][] = $_GET['page2'];

$data['logotext'] = '<font color="#cc0000">OKKO\'S Excursions</font>
';
//**/print_r( $data );
$root_dir = './pages/';
if (is_dir($root_dir))
{
   if ($dh = opendir($root_dir))
   {
      while (($file = readdir($dh)) !== false)
      {
			//**/print_r($file);
         if( $file == '.' || $file == '..' )
         {
            continue;
         }
         if( filetype( $root_dir . $file ) == 'dir' )
         {
            $sections[] = array('url'=>$file, 'name'=>$file);
         }
      }
      closedir($dh);
   }
}

$pages = collect_dirs( './pages/' . ($_GET['section'] ? $_GET['section'] . '/' : '') );
//**/print_r($pages);

function &collect_dirs( $dir )
{
   $dir_order = array();

   if (is_dir($dir))
   {
      if ($dh = opendir($dir))
      {
         while (($file = readdir($dh)) !== false)
         {
            if( $file == '.' || $file == '..' )
            {
               continue;
            }

            if( substr($file,0,3) == '!--' )
            {
               continue;
            }
            if( substr($file,0,3) == '---' )
            {
               continue;
            }

            if( $file == '.dir_order' )  # we want to sort items in directory
            {
               $dir_order = file( $dir . $file );
               continue;
            }

            if( filetype( $dir . $file ) == 'file' )
            {
               // file is divided to filename and extension by last period
               $filename_a = explode('.', $file);
               $ext = array_pop($filename_a);
               $filename = implode('.', $filename_a);
               
               $pages[$filename][$ext] = $dir . $filename;
               if( $ext == 'link' )
               {
                  $pages[$filename][$ext] = file_get_contents( $dir . $file ) . '&s3=' . substr($file,0,3);
                  #echo ($pages[$filename][$ext]);
               }
            }
            else if( filetype( $dir . $file ) == 'dir' )
            {
               $pages[$file]['pages'] = collect_dirs( $dir . $file . '/' );
            }
         }
         closedir($dh);
      }
   }

   ksort( $pages );
   //**/print_r($pages);

   if( count( $dir_order ) > 0 ) # we want to sort items in directory
   {
      foreach( $dir_order as $_key => $_value )
      {
         $dir_order[$_key] = trim($_value) ? trim($_value) : '<br c="' . ++$i . '"/>';
      }
      $dir_order = array_flip( $dir_order );

      foreach( array_keys($pages) as $_pagename )
      {
         $dir_order[$_pagename] = $pages[$_pagename];
      }

      $pages = $dir_order;
   }

   //**/print_r($pages); 

   return $pages;
}

foreach($pages as $name => $page)
{
   if( $name == 'index' )
   {
      continue;
   }
   $data['pages'][$name] = $page;
}


#print_r($_GET);die();
#print_r($pages);die();

if (isset($pages[$_GET['page']]['pages'][$_GET['page2']]))
{
#print_r($_GET);print_r($pages);die();
   $data['page'] = $pages[$_GET['page']]['pages'][$_GET['page2']];
}
elseif (isset($pages[$_GET['page']]))
{
   $data['page'] = $pages[$_GET['page']];
}
else
{
   $data['page'] = $pages['index'];
//**/print_r( $data );
}

$contents_file = $data['page']['html'] . '.html';
if( is_file( $contents_file ) )
{
	$data['contents'] = file_get_contents( $contents_file );

	//
	// replace email addresses with links
	//
	$pattern = '([\w\.]+@[\w\.]+)';
	$replacement = '<a href="mailto:${0}">${0}</a>';
	$data['contents'] = preg_replace($pattern, $replacement, $data['contents']);

	//
	// replace web addresses with links
	//
	$pattern = '(www\.[\w\.\/\-]+)';
	$replacement = '<a href="http://${0}" target="_blank">${0}</a>';
	$data['contents'] = preg_replace($pattern, $replacement, $data['contents']);

	//
	// replace logo's
	//
	$pattern = '(GHLOGO)';
	$replacement = $data['logotext'];
	$data['contents'] = preg_replace($pattern, $replacement, $data['contents']);

}


if (isset($data['page']['jpg']))
{
   $data['floatimage']['url'] = $data['floatimage']['alt'] = $data['page']['jpg'] . '.jpg';
}
$data['sections'] = $sections;
/*

*/

#echo('<pre>');
#print_r($_GET);
#print_r($data);
#echo('</pre>');


//
// preset site-global data
//
$data['sitename'] = '<a href="/" style="text-decoration:none;"><b>' . $data['logotext'] . '</b></a>';
$data['footer'] = 'GolfHockey&copy; 2008, 2009';

$data['section']['url'] = $_GET['section'];

$controllerdir = 'pages';
$sectioncontroller = $controllerdir . '/' . $_GET['section'] . '.php';
if (is_file($sectioncontroller))
{
   include($sectioncontroller);
}

$pagecontroller = $data['page']['php'] . '.php';
$controllerdir = dirname($pagecontroller);
//**/print_r( $data );
if (is_file($pagecontroller))
{
   include($pagecontroller);
}


include("theme/2colfix/layout.php");

?>
