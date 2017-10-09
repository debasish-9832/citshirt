<?php
/**
 * @author tshirtecommerce - www.tshirtecommerce.com
 * @date: 2015-01-10
 * 
 * @copyright  Copyright (C) 2015 tshirtecommerce.com. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 *
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	echo $css;
	$options = json_decode($breadcrumb->content);
	$lang = getLanguages();
?>
<ul class="breadcrumb <?php if(isset($options->layout)) echo $options->layout;?> <?php if(isset($options->class_sfx)) echo $options->class_sfx; ?>">
	<?php 
		if(isset($options->show_icon) && $options->show_icon == 'yes')
			$home = '<i class="fa fa-home"></i>';
		else
			$home = language('home', $lang);
			
		if(count($breadcrumbs))
		{
			echo '<li><a href="'.site_url().'">'.$home.'</a></li>';
			$count = count($breadcrumbs);
			$i = 1;
			foreach($breadcrumbs as $val)
			{
				if($i == $count)
					echo '<li class="active">'.$val['title'].'</li>';
				else
					echo '<li><a href="'.$val['href'].'">'.$val['title'].'</a></li>';
				$i++;
			}
		}else
		{
			echo '<li class="active">'.$home.'</li>';
		}
	?>
</ul>