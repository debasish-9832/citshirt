<?php
/**
 * @author tshirtecommerce - www.tshirtecommerce.com
 * @date: 2015-01-10
 * 
 * payment with direct payments
 * 
 * @copyright  Copyright (C) 2015 tshirtecommerce.com. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 *
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Direct
{
	function __construct($options)
	{
		$this->ini = $options;	
	}
	
	function action($data = array(), $post = array(), $id)
	{		
		$ci = & get_instance();
		$ci->load->library('session');
		
		if(isset($this->ini['message']))
			$ci->session->set_flashdata('message', $this->ini['message']);
		
		$ci->load->helper('cms');
		$lang = getLanguages();
		$ci->session->set_flashdata('msg', language('order_success_msg', $lang));
		//$ci->session->set_flashdata('error', 'Your payment not success!');
		
		redirect(site_url('payment/confirm'));
	}
	
	function ipn($data = array())
	{
		redirect(site_url());
	}
}
?>