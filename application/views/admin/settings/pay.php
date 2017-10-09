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
<table id="sample-table-1" class="table table-bordered table-hover">
	<thead>
		<tr>
			<th class="center">
				<div class="checkbox-table">
					<label>
						<input id="select_all" type="checkbox" name='check_all'>
					</label>
				</div>
			</th>
			<th class="center"><?php echo lang('title'); ?></th>
			<th class="center"><?php echo lang('description'); ?></th>
			<th class="center"><?php echo lang('type'); ?></th>
			<th class="center"><?php echo lang('default'); ?></th>
			<th class="center"><?php echo lang('publish'); ?></th>
			<th class="center"><?php echo lang('action'); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php if (is_array($payment)) foreach ($payment as $pay) { ?>
			<tr>
				<td class="center">
					<div class="checkbox-table">
						<label>
							<?php if($pay->default == 1){?>
								<input type="checkbox" value="" disabled="true">
							<?php }else{ ?>
								<input type="checkbox" name="checkb[]" class="checkb" value="<?php echo $pay->id; ?>">
							<?php } ?>
						</label>
					</div>
				</td>
				<td><?php echo $pay->title; ?></td>
				<td><?php echo $pay->description; ?></td>
				<td class="center"><?php echo $pay->type; ?></td>
				<td class="center">
					<?php if ($pay->published == 0){?>
						<a href="javascript:void(0)"><i class="fa fa-square-o" style="font-size: 20px; color: #ccc; cursor: default;"></i></a>
					<?php }else if($pay->default == 1){ ?>
						<a href="javascript:void(0)"><i class="fa fa-check-square-o" style="font-size: 20px;"></i></a>
					<?php }else{ ?>
						<a class="tooltips action" href="javascript:void(0)" rel="default" data-id="<?php echo $pay->id; ?>" data-original-title="<?php echo lang('click_default');?>" data-placement="top"><i class="fa fa-square-o" style="font-size: 20px;"></i></a>
					<?php } ?>
				</td>
				<td class="center">
					<?php if($pay->default == 1){?>
						<a href="javascript:void(0);" class="btn btn-default btn-xs"><?php echo lang('publish'); ?></a>
					<?php }else if ($pay->published == 1) { ?>					   
						<a href="javascript:void(0);" class="btn btn-success btn-xs tooltips action" data-original-title="<?php echo lang('click_unpublish');?>" data-placement="top" rel="unpublish" data-id="<?php echo $pay->id; ?>" data-flag="1"><?php echo lang('publish'); ?></a>
					<?php } else { ?>
						<a href="javascript:void(0);" class="btn btn-danger btn-xs tooltips action" data-original-title="<?php echo lang('click_publish');?>" data-placement="top" rel="publish" data-id="<?php echo $pay->id; ?>" data-flag="0"><?php echo lang('unpublish'); ?></a>
					<?php } ?>
				</td>
				<td class="center">
					<div class="visible-md visible-lg hidden-sm hidden-xs">
						<a href="javascript:void(0);" rel="edit" class="btn btn-teal tooltips" data-placement="top" data-original-title="<?php echo lang('edit');?>" onclick="UIModals.init('<?php echo site_url(); ?>admin/settings/edit/payment/<?php echo $pay->id; ?>')">
							<i class="fa fa-edit"></i>
						</a>
						<?php if($pay->default == 0) { ?>
							<a rel="del" class="remove btn btn-bricky tooltips action" data-placement="top" data-original-title="<?php echo lang('remove');?>" href="javascript:void(0);" data-id="<?php echo $pay->id; ?>">
								<i class="fa fa-times"></i>
							</a>
						<?php }else{ ?>
							<a class="remove btn btn-default" href="javascript:void(0);">
								<i class="fa fa-times"></i>
							</a>
						<?php } ?>
					</div>
				</td>
			</tr>
		<?php } ?>    
	</tbody>
</table>