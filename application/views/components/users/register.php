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

$lang = getLanguages();
?>
<script src="<?php echo site_url();?>assets/plugins/validate/validate.js"></script>	
<?php if($this->session->flashdata('error') != ''){  ?>
	<div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
<?php }  ?>
<form id="fr-register" class="form-horizontal" method="POST" action="<?php echo site_url().'users/register';?>">
	<h2><?php echo language('user_register_user_registrations', $lang);?></h2>
	<div class="form-group">
		<label class="control-label col-md-3"><?php echo language('user_username', $lang);?><span class="symbol required"></span></label>
		<div class="col-md-6">
			<?php $data_fields = $this->session->flashdata('data_fields'); ?>
			<input class="form-control validate required" type="text" data-msg="<?php echo language('user_username_validate_msg', $lang);?>" data-maxlength="200" data-minlength="2" placeholder="<?php echo language('user_username', $lang);?>" name="data[username]" value="<?php if(isset($data_fields['username'])) echo $data_fields['username'];?>"/>
		</div>
	</div>
	
	<div class="form-group">
		<label class="control-label col-md-3"><?php echo language('user_your_email', $lang);?><span class="symbol required"></span></label>
		<div class="col-md-6">
			<input class="form-control validate required" type="text" data-msg="<?php echo language('user_email_validate_msg', $lang);?>" data-type="email" placeholder="<?php echo language('user_enter_email', $lang);?>" name="data[email]" value="<?php if(isset($data_fields['email'])) echo $data_fields['email'];?>"/>
		</div>
	</div>
	
	<div class="form-group">
		<label class="control-label col-md-3"><?php echo language('user_password', $lang);?><span class="symbol required"></span></label>
		<div class="col-md-6">
			<input class="form-control validate required" type="password" data-msg="<?php echo language('user_password_validate_msg', $lang);?>" data-maxlength="128" data-minlength="6" placeholder="<?php echo language('user_password', $lang);?>" name="data[password]">
		</div>
	</div>
	
	<div class="form-group">
		<label class="control-label col-md-3"><?php echo language('user_confirm_password', $lang);?><span class="symbol required"></span></label>
		<div class="col-md-6">
			<input class="form-control validate required" type="password" data-msg="<?php echo language('user_confirm_password_validate_msg', $lang);?>" data-maxlength="128" data-minlength="6" placeholder="<?php echo language('user_confirm_password', $lang);?>" name="cf_password">
		</div>
	</div>
<?php 
	if(isset($data_fields))
		$countdata = count($data_fields);
	else
		$countdata = 0;
	foreach($forms as $form)
	{
?>	
	<div class="form-group">
		<?php 
			$required = '';
			if($form->validate == 1)
				$required = '<span class="symbol required"></span>';
			if($form->title != '' && $form->type != 'checkbox') echo '<label class="control-label col-md-3">'.$form->title.$required.'</label>';
			$params = json_decode($form->params);
			
			if(!isset($data_fields[$form->id]) && $form->type == 'checkbox')
				$data_fields[$form->id] = '';
			elseif(!isset($data_fields[$form->id]))
				$data_fields[$form->id] = $form->value;
			
			$validate = '';
			if($form->validate == 1)
				$validate = 'validate required';
					
			if($form->type == 'text'){
				echo '<div class="col-md-6">';
				echo '<input class="form-control '.$validate.'" type="text" name="fields['.$form->id.']" placeholder="'.$form->title.'" data-minlength="2" data-maxlength="200" data-msg="'.$form->title.' '.language('user_field_validate_msg', $lang).'" value="'.$data_fields[$form->id].'">';
				echo '</div>';
			}elseif($form->type == 'email'){
				echo '<div class="col-md-6">';
				echo '<input class="form-control '.$validate.'" type="text" name="fields['.$form->id.']" placeholder="'.$form->title.'" data-type="email" data-msg="'.language('user_email_validate_msg', $lang).'" value="'.$data_fields[$form->id].'">';
				echo '</div>';
			}elseif($form->type == 'password'){
				echo '<div class="col-md-6">';
				echo '<input class="form-control '.$validate.'" type="password" name="fields['.$form->id.']" placeholder="'.$form->title.'" data-minlength="6" data-maxlength="128" data-msg="'.$form->title.' '.language('user_field_password_validate_msg', $lang).'" value="'.$data_fields[$form->id].'">';
				echo '</div>';
			}elseif($form->type == 'radio'){
				echo '<div class="col-md-6">';
				$value = json_decode($form->value, true);
				if(is_array($value))
				{
					$i = 0;
					foreach($value as $key=>$val)
					{
						$checked = '';
						if($data_fields[$form->id] == $val || ($countdata == 1 && $i==0))
							$checked = 'checked="checked"';
						echo '<label class="radio-inline"><input type="radio" '.$checked.' name="fields['.$form->id.']" value="'.$val.'"> '.$key.'</label>';
						$i++;
					}
				}
				echo '</div>';
			}elseif($form->type == 'checkbox'){
				$checked = '';
				if($data_fields[$form->id] == $form->value && $form->value != '')
					$checked = 'checked="checked"';
				echo '<div class="col-md-3"></div>';	
				echo '<div class="col-md-6">';
				echo '<div class="checkbox">';
				echo '<label><input type="checkbox" name="fields['.$form->id.']" '.$checked.' value="'.$form->value.'" placeholder="'.$form->title.'"> '.$form->title.'</label>';
				echo '</div>';
				echo '</div>';
			}elseif($form->type == 'select'){
				$values	= json_decode($form->value);
				
				if (count($values) > 0)
				{
					$field	= '<select autocomplete="off" name="fields['.$form->id.']" class="form-control '.$validate.'">';
					foreach ($values as $key => $value)
					{
						if ($data_fields[$form->id] == $value)
							$selected	= 'selected="selected"';
						else
							$selected	= '';
							
						$field	.= '<option value="'.$value.'" '.$selected.'> '.$key.'</option>';
					}
					$field	.= '</select>';
					echo '<div class="col-md-6">';
					echo $field;
					echo '</div>';
				}
			}elseif($form->type == 'textarea'){
				echo '<div class="col-md-6">';
				echo '<textarea rows="3" class="form-control '.$validate.'" name="fields['.$form->id.']">'.$data_fields[$form->id].'</textarea>';
				echo '</div>';
			}
		?>
	</div>
<?php } ?>
<?php echo $this->auth->getToken(); ?>
	<div class="form-group">
		<label class="col-md-3"></label>
		<div class="col-md-6">
			<button class="btn btn-primary" type="submit"><?php echo language('register_btn', $lang);?></button>
			<a href="<?php echo site_url().'user/login';?>"><?php echo language('user_or_login', $lang);?></a>
		</div>
	</div>
</form>

<script type="text/javascript">
	jQuery('#fr-register').validate();
</script>