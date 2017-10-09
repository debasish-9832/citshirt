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
<script src="<?php echo base_url('assets/plugins/validate/validate.js'); ?>" type="text/javascript"></script>
<?php echo $css; ?>

<?php 
	echo '<h3>'.$contact->title.'</h3>';
?>

<?php if(isset($msg) && $msg != '') echo '<div class="alert alert-success">'.$msg.'</div>'; ?>
<?php if(isset($error) && $error != '') echo '<div class="alert alert-danger">'.$error.'</div>'; ?>

<form id="fr-contact" action="<?php echo site_url().uri_string(); ?>" method="POST">
	
	<div class="form-group">
		<div class="row">
			<div class="col-sm-6">
				<label><?php echo language('user_your_name', $lang);?></label>
				<input type="text" name="name" class="form-control" placeholder="<?php echo language('user_name', $lang);?>" value="<?php if(isset($data['name'])) echo $data['name']; ?>"/>
			</div>
			
			<div class="col-sm-6">
				<label><?php echo language('user_your_email', $lang);?></label>
				<input type="text" name="email" class="form-control required validate" value="<?php if(isset($data['email'])) echo $data['email']; ?>" data-type="email" data-msg="<?php echo language('user_email_validate_msg', $lang);?>" placeholder="<?php echo language('user_enter_email', $lang);?>"/>
			</div>
		</div>
	</div>
	
	<div class="form-group">
		<div class="row">
			<div class="col-sm-12">
				<label><?php echo language('subject', $lang);?></label>
				<input type="text" name="subject" class="form-control required validate" value="<?php if(isset($data['subject'])) echo $data['subject']; ?>" data-minlength="2" data-maxlength="200" data-msg="<?php echo language('subject_validate_msg', $lang);?>"  placeholder="<?php echo language('subject', $lang);?>"/>
			</div>
		</div>
	</div>
	
	<?php 
		if(count($forms) > 0)
		{
		foreach($forms as $form)
		{ 
	?>
			
		<div class="form-group">
			<div class="row">
				<div class="col-md-12">
				<?php 
					if($form->title != '' && $form->type != 'checkbox') echo '<label>'.$form->title.'</label>';
					$params = json_decode($form->params);
					
					if(!isset($data_fields[$form->name]))
						$data_fields[$form->name] = $form->value;
					
					$validate = '';
					if($form->validate == 1)
						$validate = 'validate required';
							
					if($form->type == 'text'){
						echo '<input class="form-control '.$validate.'" type="text" name="fields['.$form->name.']" placeholder="'.$form->title.'" data-minlength="2" data-maxlength="200" data-msg="'.$form->title.' '.language('user_field_validate_msg', $lang).'" value="'.$data_fields[$form->name].'">';
						echo '<input type="hidden" name="titles['.$form->name.']" value="'.$form->title.'">';
					}elseif($form->type == 'email'){
						echo '<input class="form-control '.$validate.'" type="text" name="fields['.$form->name.']" placeholder="'.$form->title.'" data-type="email" data-msg="'.language('user_email_validate_msg', $lang).'" value="'.$data_fields[$form->name].'">';
						echo '<input type="hidden" name="titles['.$form->name.']" value="'.$form->title.'">';
					}elseif($form->type == 'password'){
						echo '<input class="form-control '.$validate.'" type="password" name="fields['.$form->name.']" placeholder="'.$form->title.'" data-minlength="6" data-maxlength="128" data-msg="'.$form->title.' '.language('user_field_password_validate_msg', $lang).'" value="'.$data_fields[$form->name].'">';
						echo '<input type="hidden" name="titles['.$form->name.']" value="'.$form->title.'">';
					}elseif($form->type == 'radio'){
						$value = json_decode($form->value, true);
						if(is_array($value))
						{
							foreach($value as $key=>$val)
							{
								$checked = '';
								if($data_fields[$form->name] == $val)
									$checked = 'checked="checked"';
								echo '<label class="radio-inline"><input type="radio" '.$checked.' name="fields['.$form->name.']" value="'.$val.'"> '.$key.'</label>';
							}
							echo '<input type="hidden" name="titles['.$form->name.']" value="'.$form->title.'">';
						}
					}elseif($form->type == 'checkbox'){
						$checked = '';
						if($data_fields[$form->name] == $form->value && $form->value != '')
							$checked = 'checked="checked"';
						echo '<div class="checkbox">';
						echo '<label><input type="checkbox" name="fields['.$form->name.']" '.$checked.' value="'.$data_fields[$form->name].'" placeholder="'.$form->title.'"> '.$form->title.'</label>';
						echo '</div>';
						echo '<input type="hidden" name="titles['.$form->name.']" value="'.$form->title.'">';
					}elseif($form->type == 'select'){
						$values	= json_decode($form->value);
						
						if (count($values) > 0)
						{
							$field	= '<select autocomplete="off" name="fields['.$form->name.']" class="form-control '.$validate.'">';
							foreach ($values as $key => $value)
							{
								if ($data_fields[$form->name] == $value)
									$selected	= 'selected="selected"';
								else
									$selected	= '';
									
								$field	.= '<option value="'.$value.'" '.$selected.'> '.$key.'</option>';
							}
							$field	.= '</select>';
							echo $field;
							echo '<input type="hidden" name="titles['.$form->name.']" value="'.$form->title.'">';
						}
					}elseif($form->type == 'textarea'){
						echo '<textarea rows="3" class="form-control '.$validate.'" name="fields['.$form->name.']">'.$form->value.'</textarea>';
						echo '<input type="hidden" name="titles['.$form->name.']" value="'.$form->title.'">';
					}
				?>
				</div>
			</div>
		</div>
		
	<?php } } ?>
	
	<div class="form-group">
		<label><?php echo language('message', $lang);?></label>
		<textarea name="message" class="form-control" rows="8" ><?php if(isset($data['message'])) echo $data['message']; ?></textarea>
	</div>
	
	<div class="form-group">
		<button class="btn btn-primary" type="submit"><?php echo language('send_btn', $lang);?></button>
	</div>
</form>
<script type="text/javascript">
	jQuery('#fr-contact').validate();
</script>