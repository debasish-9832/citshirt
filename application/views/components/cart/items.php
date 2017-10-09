<?php
/**
 * @author tshirtecommerce - www.tshirtecommerce.com
 * @date: 2015-01-10
 * 
 * shopping cart layout
 * 
 * @copyright  Copyright (C) 2015 tshirtecommerce.com. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 *
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$cart	= $this->session->userdata('cart');

$lang = getLanguages();
// check shipping
if (isset($cart->shipping) && isset($cart->shipping->price))
	$shipping_active	= $cart->shipping->price;
else
	$shipping_active	= 0;
?>				
<?php $total=0; if (count($items) != 0) { ?>
	<tbody>
	<?php foreach($items as $key=>$item){?>
	<tr>
		<td class="left" width="40%">
			<img src="<?php echo base_url($designs[$key]['images']['front']);?>" alt="<?php echo $item['name']; ?>" class="img-thumbnail img-responsive" />
		</td>
		
		<td class="left" width="60%">
			<h5><a href="" title=""><?php echo $item['name']; ?></a></h5>
			
			<?php if ($item['options']) { ?>
			<div class="cart-more">
				<div class="cart-more-display" style="display:none;">
					<div class="form-group">
						<strong><?php echo language('color', $lang);?></strong>
						<p><span class="bg-colors" style="background-color:#<?php echo $designs[$key]['color'] ?>"></span></p>
					</div>
															
					<?php foreach($item['options'] as $option) { ?>										
						<strong><?php echo $option['name']; ?>: </strong>
						<p>
						<?php 
							if (is_string($option['value'])) echo $option['value'];
							else if (is_array($option['value']) && count($option['value']))
							{
								foreach($option['value'] as $v=>$value)
								{
									if ($option['type'] == 'textlist')
										echo $v .' - '.$value.'; ';
									else
										echo $value.'; ';
								}
							}
						?>
						</p>
					<?php } ?>										
				</div>
				<p><a onclick="" href="#" class="text-success"><i class="fa fa-angle-down"></i> <small><?php echo language('cart_click_more_detail', $lang); ?></small></a></p>
			</div>
			<?php } ?>
			<p class="pull-left"><?php echo language('qty', $lang);?>: <?php echo $item['qty']; ?></p>
			<strong class="pull-right"><?php echo $item['symbol'] . number_format(($item['subtotal'] + $item['customPrice']), 2, '.', ','); ?></strong>
		</td>
	</tr>
	<?php 
		$total = $total + $item['subtotal'] + $item['customPrice'];
		$symbol = $item['symbol'];
	?>
<?php } ?>						
	<tr>
		<td class="text-right"><strong><?php echo language('cart_subtotal', $lang);?></strong></td>
		<td class="text-right">							
			<span class="pull-right"><?php echo $symbol . number_format($total, 2, '.', ','); ?></span>
		</td>						
	</tr>
	<tr>
		<td class="text-right border-no"><strong><?php echo language('cart_shipping', $lang);?></strong></td>
		<td class="text-right border-no">							
			<span class="pull-right">
			<?php if ($shipping_active == 0) echo language('cart_free_shipping', $lang); else echo $symbol . number_format($shipping_active, 2, '.', ','); ?>
			</span>							
		</td>						
	</tr>
	
	<?php
		// check discount
		if (isset($cart->discount) && isset($cart->discount->id))
		{
			if ($cart->discount->discount_type == 't')
			{
				$discount	= $cart->discount->value;
			}
			else
			{
				$discount	= ($total * $cart->discount->value)/100;
			}
		}
		else
		{
			$discount	= 0;
		}
	?>
	
	<?php if ($discount > 0) { ?>
	<tr>
		<td class="text-right border-no">
			<strong><?php echo language('cart_discount', $lang);?></strong>
			<small style="display:block; clear:both;">
			<?php echo language('coupon', $lang).' '.$cart->discount->code; ?>
			</small>
		</td>
		<td class="text-right border-no">							
			<span class="pull-right">
			<?php echo $symbol . number_format($discount, 2, '.', ','); ?>
			</span>							
		</td>						
	</tr>
	<?php } ?>
	<tr>
		<td class="text-right border-no"><strong><?php echo language('total', $lang);?></strong></td>
		<td class="text-right border-no">
			<strong class="pull-right"><?php echo $symbol . number_format($total + $shipping_active - $discount, 2, '.', ','); ?></strong>							
		</td>						
	</tr>
	</tbody>
<?php } ?>