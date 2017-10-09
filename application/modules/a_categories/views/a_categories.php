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

	if(count($categories))
	{
		echo $css;
		$content = json_decode($category->content);
		if(isset($content->cate_id) && $content->cate_id != '')
			$cate_id = $content->cate_id;
		else
			$cate_id = 0;
		if(isset($content->show_title) && $content->show_title == 'yes')
			echo '<h4>'.$category->title.'</h4>';
		
		if(isset($content->show_level) && $content->show_level != '')
			$show_level = $content->show_level;
		else
			$show_level = '';
		echo '<div class="module-categories">';
		
		if(isset($content->show_number) && $content->show_number != '')
			$show_number = $content->show_number;
		else
			$show_number = 8;
			
		if(isset($content->layout) && $content->layout == 'list')
		{
			echo '<ul class="nav nav-list list-categories module-categories-'.$category->id.'">';
			$categories = dispayListCate($categories, $cate_id, 'blog/category/', $show_level);
			$categories = explode('<li>', $categories);
			$i=0;
			foreach($categories as $val)
			{
				if($show_number < $i)
					break;
				if($val != '')
					echo '<li>'.$val.'</li>';
				$i++;
			}
		}else
		{
			echo '<ul class="thumb-categories">';
			$categories = dispayThumbCate($categories, $cate_id, $show_level, 'blog/category/');
			$categories = explode('<li>', $categories);
			$i=0;
			foreach($categories as $val)
			{
				if($show_number < $i)
					break;
				if($val != '')
					echo '<li>'.$val.'</li>';
				$i++;
			}
		}
		echo '</ul>';
		echo '</div>';
	?>

	<script type="text/javascript">
		jQuery('.<?php echo 'module-categories-'.$category->id;?> li').each(function(){
			var check = jQuery(this).children('ul').children('li').hasClass('active');
			if(check)
			{	
				jQuery(this).children('ul').show();
				jQuery(this).addClass('active');
				if(jQuery(this).children('span').hasClass('glyphicon-plus'))
				{
					jQuery(this).children('span').removeClass('glyphicon-plus');
					jQuery(this).children('span').addClass('glyphicon-minus');
				}else
				{
					jQuery(this).children('span').removeClass('glyphicon-minus');
					jQuery(this).children('span').addClass('glyphicon-plus');
				}
			}
			var check_child = jQuery(this).children('ul').children('li').children('ul').children('li').hasClass('active');
			if(check_child)
			{	
				jQuery(this).children('ul').show();
				jQuery(this).addClass('active');
				if(jQuery(this).children('span').hasClass('glyphicon-plus'))
				{
					jQuery(this).children('span').removeClass('glyphicon-plus');
					jQuery(this).children('span').addClass('glyphicon-minus');
				}else
				{
					jQuery(this).children('span').removeClass('glyphicon-minus');
					jQuery(this).children('span').addClass('glyphicon-plus');
				}
			}
		});
		function list_cate_toggle_<?php echo $category->id;?>(e)
		{
			if(jQuery(e).hasClass('glyphicon-plus'))
			{
				jQuery(e).removeClass('glyphicon-plus');
				jQuery(e).addClass('glyphicon-minus');
			}else
			{
				jQuery(e).removeClass('glyphicon-minus');
				jQuery(e).addClass('glyphicon-plus');
			}
			jQuery('#<?php echo 'module-category-'.$category->id;?>').children('li').removeClass('actived');
			jQuery(e).parent('li').addClass('actived');
			jQuery(e).parent('li').children('ul').toggle();
		};
	</script>
<?php } ?>