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
	if(isset($image->content))
	{
		$options = json_decode($image->options);
		
		if(!isset($options->class_sfx))
			$options->class_sfx = '';
		if(!isset($options->alignment))
			$options->alignment = '';
			
		if(!isset($options->width))
			$options->width = '';
		if(!isset($options->height))
			$options->height = '';
		if(!isset($options->style))
			$options->style = '';
		if(!isset($options->popup))
			$options->popup = '';
		if(isset($options->target) && $options->target != '')
			$target = 'target="'.$options->target.'"';
		else
			$target = '';
			
		if(isset($options->animation) && $options->animation != '')
			$animation = 'animated '.$options->animation;
		else
			$animation = '';
		
		if($options->alignment == 'left')
			echo '<div class="module-image '.$animation.' '.$options->class_sfx.'" style="float: left;" >';
		elseif($options->alignment == 'right')
			echo '<div class="module-image '.$animation.' '.$options->class_sfx.'" style="float: right;" >';
		else
			echo '<div class="module-image '.$animation.' '.$options->class_sfx.'">';
			
		if(!isset($options->size))
			$options->size = '';
		if(!isset($options->style))
			$options->style = '';
			
		if($options->width != '' && $options->height != '')
			$size = 'width: '.$options->width.'px; height: '.$options->height.'px';
		else if($options->width != '')
			$size = 'width: '.$options->width.'px;';
		else if($options->height != '')
			$size = 'height: '.$options->height.'px;';
		else
			$size = '';
			
		$responsive = 'img-responsive';
		if($options->popup == 'yes')
		{
			echo '<script src="'.base_url('assets/plugins/jquery-fancybox/jquery.fancybox.js').'" type="text/javascript"></script>';
			echo '<link href="'.base_url('assets/plugins/jquery-fancybox/jquery.fancybox.css').'" rel="stylesheet"/>';
			if($options->alignment == 'center')	
				echo '<a class="fancybox-'.$image->id.'" href="'.base_url($image->content).'"><img src="'.base_url($image->content).'" style="margin: 0px auto; '.$size.'" alt="'.$image->title.'" class="'.$options->style.' '.$responsive.'"></a>'; 
			else
				echo '<a class="fancybox-'.$image->id.'" href="'.base_url($image->content).'"><img src="'.base_url($image->content).'" style="'.$size.'" alt="'.$image->title.'" class="'.$options->style.' '.$responsive.'"></a>'; 
			echo '<script type="text/javascript">
				jQuery(".fancybox-'.$image->id.'").fancybox();
			</script>';
		}else
		{
			if(isset($options->link) && $options->link != '' && strlen($options->link) > 7)
			{
				if($options->alignment == 'center')
					echo '<a '.$target.' href="'.$options->link.'"><img src="'.base_url($image->content).'" style="margin: 0px auto; '.$size.'" alt="'.$image->title.'" class="'.$options->style.' '.$responsive.'"></a>'; 
				else
					echo '<a '.$target.' href="'.$options->link.'"><img src="'.base_url($image->content).'" style="'.$size.'" alt="'.$image->title.'" class="'.$options->style.' '.$responsive.'"></a>'; 
			}else
			{
				if($options->alignment == 'center')
					echo '<img src="'.base_url($image->content).'" style="'.$size.'" alt="'.$image->title.'" class="margin: 0px auto; '.$options->style.' '.$responsive.'">'; 
				else
					echo '<img src="'.base_url($image->content).'" style="'.$size.'" alt="'.$image->title.'" class="'.$options->style.' '.$responsive.'">'; 
			}
		}
		echo '</div>';
	}
?>

<?php 

if($animation != '')
{ 
?>
<style>
	@charset "UTF-8";
	.animated {
	  -webkit-animation-duration: 1s;
	  animation-duration: 1s;
	  -webkit-animation-fill-mode: both;
	  animation-fill-mode: both;
	}
	.animated.infinite {
	  -webkit-animation-iteration-count: infinite;
	  animation-iteration-count: infinite;
	}
	.animated.hinge {
	  -webkit-animation-duration: 2s;
	  animation-duration: 2s;
	}
	.animated.bounceIn,
	.animated.bounceOut {
	  -webkit-animation-duration: .75s;
	  animation-duration: .75s;
	}
	.animated.flipOutX,
	.animated.flipOutY {
	  -webkit-animation-duration: .75s;
	  animation-duration: .75s;
	}
	
	/*slideInUp*/
	@-webkit-keyframes slideInUp {
	  0% {
		-webkit-transform: translate3d(0, 100%, 0);
		transform: translate3d(0, 100%, 0);
		visibility: visible;
	  }

	  100% {
		-webkit-transform: translate3d(0, 0, 0);
		transform: translate3d(0, 0, 0);
	  }
	}

	@keyframes slideInUp {
	  0% {
		-webkit-transform: translate3d(0, 100%, 0);
		transform: translate3d(0, 100%, 0);
		visibility: visible;
	  }

	  100% {
		-webkit-transform: translate3d(0, 0, 0);
		transform: translate3d(0, 0, 0);
	  }
	}

	.slideInUp {
	  -webkit-animation-name: slideInUp;
	  animation-name: slideInUp;
	}
	
	/*slideInDown*/
	@-webkit-keyframes slideInDown {
	  0% {
		-webkit-transform: translate3d(0, -100%, 0);
		transform: translate3d(0, -100%, 0);
		visibility: visible;
	  }

	  100% {
		-webkit-transform: translate3d(0, 0, 0);
		transform: translate3d(0, 0, 0);
	  }
	}

	@keyframes slideInDown {
	  0% {
		-webkit-transform: translate3d(0, -100%, 0);
		transform: translate3d(0, -100%, 0);
		visibility: visible;
	  }

	  100% {
		-webkit-transform: translate3d(0, 0, 0);
		transform: translate3d(0, 0, 0);
	  }
	}

	.slideInDown {
	  -webkit-animation-name: slideInDown;
	  animation-name: slideInDown;
	}
	
	/*slideInLeft*/
	@-webkit-keyframes slideInLeft {
	  0% {
		-webkit-transform: translate3d(-100%, 0, 0);
		transform: translate3d(-100%, 0, 0);
		visibility: visible;
	  }

	  100% {
		-webkit-transform: translate3d(0, 0, 0);
		transform: translate3d(0, 0, 0);
	  }
	}

	@keyframes slideInLeft {
	  0% {
		-webkit-transform: translate3d(-100%, 0, 0);
		transform: translate3d(-100%, 0, 0);
		visibility: visible;
	  }

	  100% {
		-webkit-transform: translate3d(0, 0, 0);
		transform: translate3d(0, 0, 0);
	  }
	}

	.slideInLeft {
	  -webkit-animation-name: slideInLeft;
	  animation-name: slideInLeft;
	}
	
	/*slideInRight*/
	@-webkit-keyframes slideInRight {
	  0% {
		-webkit-transform: translate3d(100%, 0, 0);
		transform: translate3d(100%, 0, 0);
		visibility: visible;
	  }

	  100% {
		-webkit-transform: translate3d(0, 0, 0);
		transform: translate3d(0, 0, 0);
	  }
	}

	@keyframes slideInRight {
	  0% {
		-webkit-transform: translate3d(100%, 0, 0);
		transform: translate3d(100%, 0, 0);
		visibility: visible;
	  }

	  100% {
		-webkit-transform: translate3d(0, 0, 0);
		transform: translate3d(0, 0, 0);
	  }
	}

	.slideInRight {
	  -webkit-animation-name: slideInRight;
	  animation-name: slideInRight;
	}
	
	@-webkit-keyframes zoomIn {
	  0% {
		opacity: 0;
		-webkit-transform: scale3d(.3, .3, .3);
		transform: scale3d(.3, .3, .3);
	  }

	  50% {
		opacity: 1;
	  }
	}

	@keyframes zoomIn {
	  0% {
		opacity: 0;
		-webkit-transform: scale3d(.3, .3, .3);
		transform: scale3d(.3, .3, .3);
	  }

	  50% {
		opacity: 1;
	  }
	}

	.zoomIn {
	  -webkit-animation-name: zoomIn;
	  animation-name: zoomIn;
	}
</style>
<?php } ?>