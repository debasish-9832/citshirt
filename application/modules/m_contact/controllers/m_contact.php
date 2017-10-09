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

class M_Contact extends MY_Controller{ 

	public function __construct(){
		parent::__construct();	
	} 
	
	public function index($id = '')
	{
		$this->load->helper('url');
		$this->load->helper('cms');
		$lang = getLanguages();
		$this->data['lang'] = $lang;
		
		$this->m_contact_m = $this->load->model('m_contact/m_contact_m');
		
		$this->data['forms'] = $this->m_contact_m->getFormField('contact');
		$contact = $this->m_contact_m->getContact($id);
		
		if($email = $this->input->post('email'))
		{
			$this->load->library('form_validation');
			if(count($contact) > 0)
			{
				$this->form_validation->set_rules('subject', language('subject', $lang), 'trim|required|min_length[2]|max_length[200]');
				$this->form_validation->set_rules('email', language('user_your_email', $lang), 'trim|required|valid_email');
				
				if ($this->form_validation->run() == TRUE)
				{
					$name = $this->input->post('name');
					$subject = $this->input->post('subject');
					$message = $this->input->post('message');
					
					// send email
					$config = array(
						'mailtype' => 'html',
					);
					$this->load->library('email', $config);
					$this->email->from($email, getSiteName(config_item('site_name')));
					$this->email->to($contact->email);  
					if($contact->copy == 1)
						$this->email->cc($email);
					if($contact->subject != '' && strpos($contact->subject, '{content}') > 0) // add subject
						$this->email->subject (str_replace('{content}', $subject, $contact->subject));
					else
						$this->email->subject ($subject);
						
					if($contact->message != '' && strpos($contact->message, '{content}') > 0) // add message
						$message = str_replace('{content}', $message, $contact->message);
					
					$fields = $this->input->post('fields');
					$titles = $this->input->post('titles');
					$add_info = '';
					if(is_array($fields))
					{
						foreach($fields as $key=>$val)
						{
							if(isset($titles[$key]))
								$title = $titles[$key];
							else
								$title = '';
							
							$add_info .= $add_info.'<p>'.$title.': '.$val.'</p>';
						}
					}
					
					$this->email->message ($add_info.$message); 
				
					if ($this->email->send())
					{
						$this->data['msg'] = language('send_email_success_msg', $lang);
					}else
					{
						$this->data['error'] = language('send_email_error_msg', $lang);
						$this->data['data'] = $this->input->post();
					}
					
				}else
				{
					$this->data['error'] = validation_errors();
					$this->data['data'] = $this->input->post();
				}
			}else
			{
				$this->data['error'] = language('data_not_found', $lang);
			}
		}
		
		if(count($contact) > 0)
		{
			$css = getCss($contact, 'module');
			$this->data['contact']	= $contact;	
			$this->data['css']	= $css;	
			$this->load->view('m_contact', $this->data);
		}
	}
}