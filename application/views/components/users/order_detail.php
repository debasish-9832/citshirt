<?php $lang = getLanguages(); $setting = getSettings(); ?>

<link rel="stylesheet" type="text/css" href="<?php echo site_url().'assets/plugins/jquery-fancybox/jquery.fancybox.css'; ?>" media="screen" />
<script type="text/javascript" src="<?php echo site_url().'assets/plugins/jquery-fancybox/jquery.fancybox.js'; ?>"></script>

<div class="profile">
	<h2><?php echo language('user_order_detail', $lang);?></h2>
	<hr/>
	<div class="row">
		<div class="col-md-9">
		<?php if (count($order)) { ?>
			<div class="order_detail_body">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title"><?php echo language('user_order_info', $lang);?></h4>
					</div>
					
					<div class="panel-body">
						<div class="col-md-6">
							<h4><?php echo language('billing_address', $lang);?></h4>
							
							<div class="row">
								<label class="col-md-4 text-right"><?php echo language('name', $lang); ?>:</label>
								<span class="col-md-8 text-left">
									<a href="<?php echo site_url('user/myaccount'); ?>" title="<?php echo $order->name; ?>">
										<strong><?php echo $order->name; ?></strong>
									</a>
								</span>
							</div>
							
							<div class="row">
								<label class="col-md-4 text-right"><?php echo language('user_username', $lang); ?>:</label>
								<span class="col-md-8 text-left">
									<a href="<?php echo site_url('user/myaccount'); ?>" title="<?php echo $order->username; ?>">
										<strong><?php echo $order->username; ?></strong>
									</a>
								</span>
							</div>
							
							<div class="row">
								<label class="col-md-4 text-right"><?php echo language('user_email', $lang); ?>:</label>
								<span class="col-md-8 text-left"><?php echo $order->email; ?></span>
							</div>								
						</div>
						
						<!-- user Shipping  info -->
						<div class="col-md-6">
							<h4><?php echo language('shipping_address', $lang);?></h4>
							<?php if ($address !== false) { ?>
								
								<?php foreach ($address as $key => $value) { ?>
								<div class="row">
									<label class="col-sm-5 text-right"><?php echo $key; ?>:</label>
									<span class="col-sm-7 text-left"><?php echo $value; ?></span>
								</div>
								<?php } ?>
								
							<?php } ?>							
						</div>
					</div>
				</div>
				
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title"><?php echo language('user_order_history', $lang);?></h4>
					</div>
					
					<div class="panel-body">
						<div class="col-md-3">
							<div class="row">
								<label class="col-md-7 text-right"><?php echo language('user_order_number', $lang);?>:</label>
								<a href="<?php echo site_url().uri_string(); ?>"><?php echo $order->order_number; ?></a>
							</div>
							<div class="row">
								<label class="col-md-7 text-right"><?php echo language('date', $lang);?>:</label>
								<span><?php echo date("Y-m-d", strtotime($order->created_on)); ?></a></span>
							</div>
							<div class="row">
								<label class="col-md-7 text-right"><?php echo language('status', $lang);?>:</label>
								<span><strong><?php echo language($order->status, $lang); ?></strong></span>
							</div>
							<div class="row">
								<div class="col-sm-12"><a target="_blank" href="<?php echo site_url().'user/invoice/'.$order->id;?>"><?php echo language('user_order_download_pdf', $lang);?></a></div>
							</div>
						</div>
						
						<div class="col-md-9">
							<div class="table-responsive">
								<table class="table table-bordered table-hover">
									<thead>
										<tr>
											<th class="center" style="width: 15%;"><?php echo language('type', $lang); ?></th>
											<th class="center"><?php echo language('status_or_note', $lang); ?></th>
											<th class="center" style="width: 15%;"><?php echo language('date', $lang); ?></th>
										</tr>
									</thead>
									<tbody>
										<?php foreach($histories as $history){ ?>
											<tr>
											<?php foreach($history as $key=>$val){ ?>
													<?php 
														if($key == 'content')
														{
															$item = json_decode($val);
															foreach($item as $k=>$v)
															{
																$valu = language($v, $lang);
																if($valu == '')
																	$valu = $v;
																echo '<td>'.$valu.'</td>';
															}
														}elseif($key == 'label')
														{
															echo '<td class="center">'.language($val, $lang).'</td>';
														}elseif($key == 'date')
														{
															echo '<td class="center">'.$val.'</td>';
														}
													?>
											<?php } ?>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>

				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title"><?php echo language('user_order_detail', $lang);?></h4>
					</div>
					
					<div class="panel-body">
						<div class="table-responsive">
							<table id="table_order_detail" class="table table-bordered table-hover" style="margin-top: 20px;">
								<thead>
									<tr>
										<th class="center" style="width: 18%;"><?php echo language('view_design', $lang); ?></th>
										<th class="center" style="width: 18%;"><?php echo language('name', $lang); ?></th>
										<th class="center" style="width: 6%;"><?php echo language('sku', $lang); ?></th>
										<th class="center" style="width: 12%;"><?php echo language('status', $lang); ?></th>
										<th class="center" style="width: 7%;"><?php echo language('product_price', $lang); ?></th>
										<th class="center" style="width: 7%;"><?php echo language('print_price', $lang); ?></th>
										<th class="center" style="width: 7%;"><?php echo language('clipart_price', $lang); ?></th>
										<th class="center" style="width: 7%;"><?php echo language('product_attributes', $lang); ?></th>
										<th class="center" style="width: 7%;"><?php echo language('qty', $lang); ?></th>
										<th class="center" style="width: 14%;"><?php echo language('option', $lang); ?></th>
										<th class="center"  style="width: 10%;"><?php echo language('total', $lang); ?></th>
									</tr>
								</thead>
								<tbody>					
									<?php 
										$total = 0;
										$count = 1;
										$shipping_price = $order->shipping_price;
										$payment_price = 0.0;
									?>
									<?php foreach($items as $product){?>
										<tr>
											<td class="center"><a class="fancybox fancybox.iframe" href="<?php echo site_url().'user/viewdesign/'.$product->id;?>" ><?php echo language('view', $lang);?></a></td>
											<td>
												<a target="_blank" href="<?php echo site_url('product/'.$product->product_id); ?>" title="<?php echo $product->product_name; ?>">
													<strong><?php echo $product->product_name; ?></strong>
												</a>
											</td>
											<td><?php echo $product->product_sku;?></td>
											<td class="left"><?php echo language($product->poduct_status, $lang); ?></td>
											<td class="right"><?php echo $setting->currency_symbol.number_format($product->product_price, 2);?></td>
											<td class="right"><?php echo $setting->currency_symbol.number_format($product->price_print, 2);?></td>
											<td class="right"><?php echo $setting->currency_symbol.number_format($product->price_clipart, 2);?></td>
											<td class="right"><?php echo $setting->currency_symbol.number_format($product->price_attributes, 2);?></td>
											<td class="right"><?php echo $product->quantity;?></td>
											<td class="left">
												<?php
													
													if($product->attributes != '' && $product->attributes != '"[]"')
													{
														$size = json_decode(json_decode($product->attributes), true);										
														if (count($size) > 0)
														{
															foreach($size as $option) { ?>
																<div>
																	<strong><?php echo $option['name']; ?>: </strong>
																	<?php 
																		if (is_string($option['value'])) echo $option['value'];
																		elseif (is_array($option['value']) && count($option['value']))
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
																</div>
															<?php }
														}
													}
												?>
											</td>
											<?php $total_row = $product->quantity*($product->product_price+$product->price_print+$product->price_clipart)+$product->price_attributes;?>
											<td class="right"><?php echo $setting->currency_symbol.number_format($total_row, 2);?></td>
										</tr>
										<?php 
											$total = $total+$total_row;
											$count++;
										?>
									<?php } ?>
									<!-- shipping -->
									<tr>
										<td colspan="10" class="right">
											<?php echo language('shipment_fee', $lang);?>
											
											<?php if (count($shipping)) { ?>								
												<br><small><?php echo language('cart_shipping_method', $lang); ?>: <a href="<?php echo site_url().uri_string(); ?>"><strong><?php echo $shipping->title; ?></strong></a></small>
												<br><small><?php echo $shipping->description; ?></small>
											<?php } ?>
											
										</td>
										<td class="right"><?php echo $setting->currency_symbol.number_format($shipping_price, 2);?></td>
									</tr>
									
									<!-- payment -->
									<tr>
										<td colspan="10" class="right">
											<?php echo language('payment_fee', $lang);?>
											
											<?php if (count($payment)) { ?>								
												<br><small><?php echo language('cart_payment_method', $lang); ?>: <a href="<?php echo site_url().uri_string(); ?>"><strong><?php echo $payment->title; ?></strong></a></small>
												<br><small><?php echo $payment->description; ?></small>
											<?php } ?>
										</td>
										<td class="right"><?php echo $setting->currency_symbol.number_format($payment_price, 2) ;?></td>
									</tr>
									
									<!-- discount -->
									<tr>
										<td colspan="10" class="right">
											<?php echo language('cart_discount', $lang);?>
											
											<?php if (count($discount)) { ?>								
												<br><small><?php echo $discount->name; ?>: <a href="<?php echo site_url().uri_string(); ?>"><strong><?php echo $discount->code; ?></strong></a></small>								
											<?php } ?>
										</td>
										<td class="right"><?php echo $setting->currency_symbol.number_format($order->discount, 2) ;?></td>
									</tr>
									
									<!-- total -->
									<tr>
										<?php $total = $total + $shipping_price - $order->discount; ?>
										<td colspan="10" class="right"><?php echo language('total', $lang);?></td>
										<td class="right" colspan="7"><strong><?php echo $setting->currency_symbol.number_format($total, 2);?><strong></td>
									</tr>
								</tbody>
							</table>
						</div>
				<?php } else { echo language('data_not_found', $lang); } ?>
					</div>
				</div>
			</div>
		</div>
		
		<div class="col-md-3">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title"><?php echo language('user_your_account', $lang);?></h4>
				</div>
				
				<div class="panel-body">
					<ul class="nav nav-list list-manager">
						<li <?php if(uri_string() == 'user/myaccount') echo 'class="active"';?>><a href="<?php echo site_url('user/myaccount'); ?>"><?php echo language('my_account', $lang);?></a></li>
						<li <?php if(uri_string() == 'user/accountdetails') echo 'class="active"';?>><a href="<?php echo site_url('user/accountdetails'); ?>"><?php echo language('user_account_detail', $lang);?></a></li>
						<li <?php if(uri_string() == 'user/changepass') echo 'class="active"';?>><a href="<?php echo site_url('user/changepass'); ?>"><?php echo language('user_change_password', $lang);?></a></li>
						<li <?php if(uri_string() == 'user/orderhistory' || strpos(uri_string(), '/orderdetail')) echo 'class="active"';?>><a href="<?php echo site_url('user/orderhistory'); ?>"><?php echo language('user_order_history', $lang);?></a></li>
						<li <?php if(uri_string() == 'user/userdesign/default') echo 'class="active"';?>><a href="<?php echo site_url('user/userdesign/default'); ?>"><?php echo language('user_manage_design', $lang);?></a></li>
						<li><a href="<?php echo site_url('users/logout'); ?>"><?php echo language('logout', $lang);?></a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	jQuery('.fancybox').fancybox();
</script>