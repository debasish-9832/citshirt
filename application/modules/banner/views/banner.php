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

?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('media/modules/banner/jquery.bxslider.css'); ?>"/>
<script src="<?php echo base_url('media/modules/banner/jquery.bxslider.js'); ?>"></script>
<?php echo $css; ?>
<div class="module-banner">
	<ul class="bxslider_<?php echo $banner->id; ?>" style="padding: 0;">
		<?php 
			$images = json_decode($banner->images);
			$captions = json_decode($banner->captions);
			$settings = json_decode($banner->settings);
			$html = '';
			for($i=0; $i<count($images); $i++)
			{
				if(isset($captions[$i]))
					echo '<li style="left: 0px;"><img src="'.base_url($images[$i]).'" alt="image" class="banner-gallery"/><div class="bx-caption">'.$captions[$i].'</div></li>';
				else
					echo '<li style="left: 0px;"><img src="'.base_url($images[$i]).'" alt="image"/></li>';
			}
		?>
	</ul>
</div>
<script type="text/javascript">
	jQuery('.bxslider_<?php echo $banner->id; ?>').bxSlider({
		<?php 
			foreach($settings as $key=>$val)
			{
				if($key == 'slideWidth' && $val == '')
				{
					echo '';
				}else if($val === 'true' || $val === 'false' || (int)$val > 0)
					echo $key.': '.$val.',';
				else
					echo $key.': "'.$val.'",';
			}
		?>
	});
</script>