<?php
/**
 * @author tshirtecommerce - www.tshirtecommerce.com
 * @date: 2015-01-10
 * 
 * user layout
 * 
 * @copyright  Copyright (C) 2015 tshirtecommerce.com. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 *
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends Frontend_Controller {
	
	public function __construct(){
        parent::__construct();
		
		$this->langs = getLanguages();
		$this->load->model('users_m');
		$this->user = $this->session->userdata('user');
    }
	
	public function index($string = '')
	{
		redirect('user/login');
	}
	
	// login form
	public function login()
	{
		if(isset($this->user['username']) && $this->user['username'] != '')
			redirect(site_url());
			
		$this->load->library('form_validation');
		$data					= array();
		$data['forms'] 			= $this->users_m->getFormField('login');
		
		$content				= $this->load->view('components/users/login', $data, true);
		
		$this->data['content']	= $content;		
		$this->data['subview'] 	= $this->load->view('layouts/user/login', array(), true);
		
		$this->data['breadcrumbs'] = array(
			0=>array(
				'title'=>language('login', $this->langs),
				'href'=>'javascript:void(0)'
			)
		);
		
		$this->theme($this->data, 'user');
	}
	
	function register()
	{
		if(isset($this->user['username']) && $this->user['username'] != '')
			redirect(site_url());
			
		$this->load->library('form_validation');
		
		$data['forms'] = $this->users_m->getFormField('register');
		
		$content				= $this->load->view('components/users/register', $data, true);
		
		$this->data['content']	= $content;	
		$this->data['subview'] 	= $this->load->view('layouts/user/register', array(), true);
		
		$this->data['breadcrumbs'] = array(
			0=>array(
				'title'=>language('register', $this->langs),
				'href'=>'javascript:void(0)'
			)
		);
		
		$this->theme($this->data, 'user');
	}
	
	function complete($msg = '')
	{
		if(isset($this->user['username']) && $this->user['username'] != '')
			redirect(site_url());
			
		if ($this->session->userdata('session_register') == 1)
		{
			$this->session->unset_userdata('session_register');
		}else{
			redirect('user/register');
		}
			
		if ($msg == 'success')
			$msg = language('user_register_complete', $this->langs);
		elseif ($msg == 'error')
			$msg = language('user_register_error', $this->langs);
		elseif ($msg == 'email')		
			$msg = language('user_register_email_fond', $this->langs);
		else
			redirect('user/register');
			
		$data['msg'] = $msg;
		
		$content				= $this->load->view('components/users/complete', $data, true);
		
		$this->data['content']	= $content;	
		$this->data['subview'] 	= $this->load->view('layouts/user/register', array(), true);
		
		$this->theme($this->data, 'user');
	}
	
	function forgotPassword()
	{
		if(isset($this->user['username']) && $this->user['username'] != '')
			redirect(site_url());
		
		$data = '';
		$content				= $this->load->view('components/users/forgot_password', $data, true);
		
		$this->data['content']	= $content;	
		$this->data['subview'] 	= $this->load->view('layouts/user/login', array(), true);
		
		$this->data['breadcrumbs'] = array(
			0=>array(
				'title'=>language('login', $this->langs),
				'href'=>site_url('user/login')
			),
			1=>array(
				'title'=>language('user_forgot_password', $this->langs),
				'href'=>'javascript:void(0)'
			)
		);
		
		$this->theme($this->data, 'user');
	}
	
	function changePass($key = '')
	{
		if(!isset($this->user['username']) && $key == '')
			redirect(site_url().'user/register');
		$data = '';
		$data['key'] = $key;
		$content				= $this->load->view('components/users/change_pass', $data, true);
		
		$this->data['content']	= $content;	
		$this->data['subview'] 	= $this->load->view('layouts/user/profile', array(), true);
		
		$this->data['breadcrumbs'] = array(
			0=>array(
				'title'=>language('my_account', $this->langs),
				'href'=>site_url('user/myaccount')
			),
			1=>array(
				'title'=>language('user_change_password', $this->langs),
				'href'=>'javascript:void(0)'
			)
		);
		
		$this->theme($this->data, 'user');
	}
	
	public function userProfile()
	{
		$data = $this->input->post();
		
		$user = $this->session->userdata('user');
		$user->user->profiles = $data;
				
		$this->session->set_userdata('user', $user);			
	}
	
	public function saveDesign()
	{
		$results	= array();
		
		// check user login
		$user = $this->session->userdata('user');
		
		if ( empty($user['id']) )
		{
			$results['error'] = 1;
			$results['login'] = 1;
			$results['msg']	= language('user_save_error', $this->langs);
			echo json_encode($results);
			exit;
		}		
		
		$data = json_decode(file_get_contents('php://input'), true);
		
		$this->load->helper('file');
		
		$path	= ROOTPATH .DS. 'media' .DS. 'assets' .DS. 'system';		
		
		$temp 		= explode(';base64,', $data['image']);
		$buffer		= base64_decode($temp[1]);
		
		$design 					= array();
		
		$design['user_id']			= $user['id'];
		$design['vectors']			= $data['vectors'];		
		$design['teams']			= $data['teams'];	
		$design['fonts']			= $data['fonts'];
				
		$designer_id				= $data['designer_id'];
		
		// check design and author
		if ($data['design_file'] != '' && $designer_id == $design['user_id'])
		{
			// override file and update
			$file 			= $data['design_file'];
			
			$path_file		= ROOTPATH .DS. str_replace('/', DS, $file);
			$id				= $data['design_id'];
			$key			= $data['design_key'];
		}
		else
		{
			// save new file
			$this->load->library('file');
			$file 		= new file();
			
			// create path file
			$date 	= new DateTime();
					
			$year	= $date->format('Y');
			$file->create($path .DS. $year, 0755);	
		
			$month 	= $date->format('m');
			$file->create($path .DS. $year .DS. $month, 0755);
			
			$key 		= strtotime("now"). rand();
			$file 		=  $key . '.png';
			$path_file	= $path .DS. $year .DS. $month .DS. $file;
			$file		= 'media/assets/system/'.$year .'/'. $month .'/'. $file;

			$id			= null;
			
			$design['design_id'] 		= $key;
		}
		
		
		if ( ! write_file($path_file, $buffer))
		{
			$results['error'] = 1;
			$results['msg']	= language('user_save_design_error', $this->langs);
		}
		else
		{
			$design['image']			= $file;
			$design['product_id']		= $data['product_id'];
			$design['product_options']  = $data['product_color'];
			
			$design['title']  			= '';
			$design['description']  	= '';
			$design['system_id']  		= '0';		
			
			$this->load->model('design_m');
						
			$id = $this->design_m->save($design, $id);
			
			if ($id > 0)
			{				
				$results['error'] = 0;
				
				$content = array(
					'design_id'=> $id,
					'design_key'=> $key,
					'designer_id'=> $user['id'],
					'design_file'=> $file,					
				);					
				$results['content'] = $content;
				
				// send email savedesign.
				
				//params shortcode email.
				$params = array(
					'username'=>$user['username'],
					'url_design'=>site_url('design/index/'.$data['product_id'].'/'.$data['product_color'].'/'.$key),
				);
				
				//config email.
				$config = array(
					'mailtype' => 'html',
				);
				$subject = configEmail('sub_save_design', $params);
				$message = configEmail('save_design', $params);
				
				$this->load->library('email', $config);
				$this->email->from(getEmail(config_item('admin_email')), getSiteName(config_item('site_name')));
				$this->email->to($user['email']);    
				$this->email->subject ( $subject);
				$this->email->message ($message);   
				$this->email->send();
			}
			else
			{
				$results['error'] = 1;
				$results['msg']	= language('user_save_design_error', $this->langs);
			}
		}
		
		echo json_encode($results);
	}
	
	public function userDesign($layout = 'default', $limit = 0)
	{		
		if ( empty($this->user['id']) )
		{			
			echo language('user_please_login_msg', $this->langs);
			exit;
		}
		
		// load design of user
		$this->load->model('design_m');
		// pagination	
		$this->load->library('pagination');
		$config['per_page'] 	= 12;
		$config['uri_segment'] 		= 4; 
		$config['next_link'] 		= language('next', $this->langs); 
		$config['prev_link'] 		= language('prev', $this->langs); 
		$config['first_link'] 		= language('first', $this->langs); 
		$config['last_link'] 		= language('last', $this->langs); 
		$config['num_links']		= 4;
		
		$this->session->set_userdata('search_design', $this->input->post('search'));
			
		$config['total_rows'] = $this->design_m->getUserDesigns(true, '', '', $this->session->userdata('search_design'));
			
		if($layout == 'default')
		{
			$config['base_url'] = site_url('user/userdesign/default');
			$this->pagination->initialize($config); 
			
			$data['links'] 		= $this->pagination->create_links();
				
			$data['designs'] = $this->design_m->getUserDesigns(false, $config['per_page'], (int) $this->uri->segment(4), $this->session->userdata('search_design'));
			
			$content				= $this->load->view('components/users/my_design', $data, true);
		
			$this->data['content']	= $content;		
			$this->data['subview'] 	= $this->load->view('layouts/user/profile', array(), true);
			
			$this->data['breadcrumbs'] = array(
				0=>array(
					'title'=>language('my_account', $this->langs),
					'href'=>site_url('user/myaccount')
				),
				1=>array(
					'title'=>language('user_manage_design', $this->langs),
					'href'=>'javascript:void(0)'
				)
			);
			
			$this->theme($this->data, 'user');
		}else
		{
			$config['base_url'] = site_url('user/userdesign/ajax');
			$this->pagination->initialize($config); 
			
			$this->data['links'] 		= $this->pagination->create_links();
				
			$this->data['data'] = $this->design_m->getUserDesigns(false, $config['per_page'], (int) $this->uri->segment(4), $this->session->userdata('search_design'));
			
			$this->load->view('components/design/design', $this->data);	
		}
	}
	
	function removeDesign($id = 0)
	{
		if (isset($this->user['id']) && $this->user['id'] > 0)
		{
			if ($id > 0)
			{
				$this->load->model('design_m');
				$this->design_m->db->where('user_id', $this->user['id']);
				$this->design_m->delete($id);
			}
		}
	}
	
	function myAccount()
	{
		if(empty($this->user['id']) || (isset($this->user['id']) && $this->user['id'] == ''))
			redirect(site_url());
			
		$data = array();
		$content				 = $this->load->view('components/users/myaccount', $data, true);
		
		$this->data['content']	 = $content;		
		$this->data['subview'] 	 = $this->load->view('layouts/user/profile', array(), true);
		
		$this->data['breadcrumbs'] = array(
			0=>array(
				'title'=>language('my_account', $this->langs),
				'href'=>'javascript:void(0)'
			)
		);
		
		$this->theme($this->data, 'user');
	}
	
	function accountDetails()
	{
		if(empty($this->user['id']) || (isset($this->user['id']) && $this->user['id'] == ''))
			redirect(site_url());
		if($name = $this->input->post('name'))
		{	
			$userdata['name'] = $name;
			if($this->users_m->save($userdata, $this->user['id']))
				$data['msg'] = language('user_edit_account_success_msg', $this->langs);
			else
				$data['error'] = language('user_edit_account_error_msg', $this->langs);
			
			$fields = $this->input->post('fields');
			if(is_array($fields) && count($fields))
			{	
				//edit fields value.
				$this->users_m->deleteFields($this->user['id']);
				foreach($fields as $k=>$val)
				{
					$field_val = array(
						'field_id'=>$k,
						'form_field'=>'register',
						'value'=>$val,
						'object'=>$this->user['id'],
					);
					saveField($field_val);
				}
			}
		}
		
		$data['forms'] = $this->users_m->getFormField('register');
		$data['form_value'] = $this->users_m->checkField($this->user['id']);
			
		$data['user'] = $this->users_m->getUser($this->user['id']);
		$content				= $this->load->view('components/users/account_details', $data, true);
		
		$this->data['content']	= $content;		
		$this->data['subview'] 	= $this->load->view('layouts/user/profile', array(), true);
		
		$this->data['breadcrumbs'] = array(
			0=>array(
				'title'=>language('my_account', $this->langs),
				'href'=>site_url('user/myaccount')
			),
			1=>array(
				'title'=>language('user_account_detail', $this->langs),
				'href'=>'javascript:void(0)'
			)
		);
		
		$this->theme($this->data, 'user');
	}
	
	function orderHistory()
	{
		if(empty($this->user['id']) || (isset($this->user['id']) && $this->user['id'] == ''))
			redirect(site_url());
			
		$this->load->model('order_m');
		
		// pagination
		$this->load->library('pagination');
		$config['base_url'] 		= site_url('user/orderhistory/index');
		
		if($option = $this->input->post('option'))
		{
			$this->session->set_userdata('search_order', $this->input->post('search'));
			$this->session->set_userdata('option_order', $option);
		}
		
		$config['total_rows']		= $this->order_m->getOrders(true, 5, 1, $this->session->userdata('search_order'), $this->session->userdata('option_order'), false);
		$config['per_page'] 	= 10;
		
		$config['uri_segment'] 		= 4;
		$config['prev_link'] 		= language('prev', $this->langs);
		$config['next_link'] 		= language('next', $this->langs);
		$config['first_link']		= language('first', $this->langs);
		$config['last_link'] 		= language('last', $this->langs);
		
		$this->pagination->initialize($config); 
		$data['per_page'] = $config['per_page'];
		$data['links'] 	= $this->pagination->create_links();
		$data['per_page'] 	= $config['per_page'];
		
		$data['orders'] = $this->order_m->getOrders(false, $config['per_page'], $this->uri->segment(4), $this->session->userdata('search_order'), $this->session->userdata('option_order'), false);
		
		$content				= $this->load->view('components/users/order_history', $data, true);
		
		$this->data['content']	= $content;		
		$this->data['subview'] 	= $this->load->view('layouts/user/profile', array(), true);
		
		$this->data['breadcrumbs'] = array(
			0=>array(
				'title'=>language('my_account', $this->langs),
				'href'=>site_url('user/myaccount')
			),
			1=>array(
				'title'=>language('user_order_history', $this->langs),
				'href'=>'javascript:void(0)'
			)
		);
		
		$this->theme($this->data, 'user');
	}
	
	function orderDetail($id = '')
	{
		if(empty($this->user['id']) || (isset($this->user['id']) && $this->user['id'] == ''))
			redirect(site_url());
			
		if((int)$id == 0)
			redirect('user/orderhistory');
			
		// get order detail
		$this->load->model('order_m');
		$order 	= $this->order_m->getOrder($id, false);
		
		if(count($order) == 0)
			redirect('user/orderhistory');	
		
		// get items
		$data['order'] = $order;
		$items = $this->order_m->getItems($id);
		$data['items'] = $items;
		
		// get histories
		$data['histories'] = $this->order_m->getHistory($id);
		
		// get user info
		$userInfo	= $this->order_m->getUserInfo($id);
		if ($userInfo !== false)
		{
			$address	= json_decode($userInfo->address);
		}
		else
		{
			$address	= false;
		}
		$data['address'] = $address;
		
		
		// get shipping method
		$this->load->model('shipping_m');
		$shipping	= $this->shipping_m->get($order->shipping_id, true);
		$data['shipping'] = $shipping;
		
		// get payment method
		$this->load->model('payment_m');
		$payment	= $this->payment_m->get($order->payment_id, true);
		$data['payment'] = $payment;
		
		// get discount
		if ($order->discount_id > 0)
		{
			$this->load->model('coupon_m');
			$discount	= $this->coupon_m->get($order->discount_id, true);
		}
		else
		{
			$discount	= array();
		}
		$data['discount'] = $discount;
		
		$content				= $this->load->view('components/users/order_detail', $data, true);
		
		$this->data['content']	= $content;		
		$this->data['subview'] 	= $this->load->view('layouts/user/profile', array(), true);
		
		$this->data['breadcrumbs'] = array(
			0=>array(
				'title'=>language('my_account', $this->langs),
				'href'=>site_url('user/myaccount')
			),
			1=>array(
				'title'=>language('user_order_history', $this->langs),
				'href'=>site_url('user/orderhistory')
			),
			2=>array(
				'title'=>language('user_order_detail', $this->langs),
				'href'=>'javascript:void(0)'
			)
		);
		
		$this->theme($this->data, 'user');
	}
	
	function invoice($id = '')
	{
		if($id == '' || $id == 0)
			redirect('user/orderhistory');
			
		if(empty($this->user['id']) || (isset($this->user['id']) && $this->user['id'] == ''))
			redirect(site_url('user/orderDetail/'.$id));
		
		$this->load->model('order_m');
		$setting = getSettings();
		
		$order = $this->order_m->getOrder($id);
		if(count($order) == 0)
			redirect('user/orderhistory');
		
		// get user info
		$billing = array(
			'name'=>$order->name,
			'username'=>$order->username,
			'email'=>$order->email,
		);
		
		$userInfo	= $this->order_m->getUserInfo($id);
		if ($userInfo !== false)
		{
			$address	= json_decode($userInfo->address, true);
		}
		else
		{
			$address	= array();
		}
		
		// get items
		$items = $this->order_m->getItems($id);
		
		// get shipping method
		$this->load->model('shipping_m');
		$shipping	= $this->shipping_m->get($order->shipping_id, true);
		
		// get payment method
		$this->load->model('payment_m');
		$payment	= $this->payment_m->get($order->payment_id, true);
		
		// get discount
		if ($order->discount_id > 0)
		{
			$this->load->model('coupon_m');
			$discounts	= $this->coupon_m->get($order->discount_id, true);
		}
		else
		{
			$discounts	= array();
		}
		
		if(empty($setting->invoice_logo))
			$setting->invoice_logo = '';
		
		// get Products.
		$design_item = $this->order_m->getDesigns($id);
		
		$data = array(
			'shop_name'=>$setting->site_name,
			'shop_url'=>site_url(),
			'logo'=>$setting->invoice_logo,
			'order_number'=>$order->order_number,
			'date'=>date("Y-m-d", strtotime($order->created_on)),
			'date_ship'=>date("Y-m-d", strtotime($order->modified_on)),
			'status'=>$order->status,
			'billing'=>$billing,
			'user_id'=>$order->user_id,
			'address'=>$address,
			'shipping'=>$shipping,
			'shipping_price'=>$order->shipping_price,
			'payment_price'=>0.0,
			'items'=>$items,
			'setting'=>$setting,
			'payment'=>$payment,
			'discounts'=>$discounts,
			'discount'=>$order->discount,
			'products'=>$design_item,
		);
		
		//create pdf.
		$this->load->library('pdf/pdf.php');
		$config = array(
			'write_type'=>'I'
		);
		
		$lang = getLanguages();

		$pdf = new Pdf($config);
		$file_name = 'Order-'.$order->order_number.'.pdf';
		$pdf->fronEndPdf($file_name, $data, $lang);
	}
	
	function viewDesign($id = '')
	{
		$lang = getLanguages();
		if(empty($this->user['id']) || (isset($this->user['id']) && $this->user['id'] == ''))
			echo language('user_please_login_msg', $lang);
			
		$this->data['setting'] = getSettings();
		$this->data['lang'] = $lang;
		$this->load->model('order_m');
		
		$this->data['product'] = $this->order_m->getDesign($id);			
		
		$this->load->view('components/users/view_design', $this->data);
	}
}

?>