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

class Setting extends Admin_Controller
{
	public function __construct ()
	{
		parent::__construct();		
		$this->lang->load('breadcrumbs');
		$this->load->model('breadcrumbs_m');
	}
	
	public function index()
	{
		// pagination
        $this->load->library('pagination'); 
        $config['base_url'] = base_url('breadcrumbs/admin/setting/index'); 
        $config['total_rows'] = $this->breadcrumbs_m->getBreadcrumbs(true);
		$config['per_page'] = 10;
        $config['uri_segment'] = 5; 
        $config['next_link'] = lang('next'); 
        $config['prev_link'] = lang('prev'); 
        $config['first_link'] = lang('first'); 
        $config['last_link'] = lang('last'); 
        $config['num_links']	= 2;                 
        $this->pagination->initialize($config); 
        $this->data['links'] = $this->pagination->create_links();
		if($this->uri->segment(4) == 'index')
			$segment = $this->uri->segment(5);
		else
			$segment = '';
			
		$this->data['breadcrumbss'] = $this->breadcrumbs_m->getBreadcrumbs(false, $config['per_page'], $segment);
		
		if($this->input->post('type') == 'ajax')
			$this->load->view('admin/ajax', $this->data);
		else
			$this->load->view('admin/index', $this->data);
	}
	
	public function edit($id = '')
	{ 
		$this->data['id'] = $id;
		if($id == '')
			$breadcrumbs = $this->breadcrumbs_m->getNew();
		else
			$breadcrumbs = $this->breadcrumbs_m->getBreadcrumb($id);
		
		if(count($breadcrumbs) > 0)
		{
			$this->data['breadcrumbs'] = $breadcrumbs;
		}else
		{
			echo '<p class="col-md-12">Data not found.</p>';
			exit;
		}
		
		$this->load->view('admin/setting', $this->data);
	}
	
	public function save($id = '')
	{
		if($params = $this->input->post('params'))
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('title', lang('title'), 'trim|required|min_length[2]|max_length[200]');
			
			if ($this->form_validation->run() == TRUE)
			{
				$data['title'] = $this->input->post('title');
				$data['content'] = json_encode($this->input->post('data'));
				$data['options'] = '';
				$data['params'] = json_encode($params);
				
				if($id == '')
				{
					$data['type'] = 'breadcrumbs';
					$data['key'] = 'breadcrumbs'.uniqid();
					if($id = $this->breadcrumbs_m->save($data))
					{
						$content = array(
							'id'		=> $id,
							'error'		=> 0,
							'key'		=> $data['key'],
							'title'		=> $data['title'],
							'module'	=> 'breadcrumbs',
							'control'	=> 'breadcrumbs',
							'method'	=> 'index',
							'content'	=> '{module:breadcrumbs/index,'.$id.'}'
						);
					}else
					{
						$content = array(
							'error' => 1,
							'content' => lang('breadcrumbs_admin_setting_add_error_msg'),
						);
					}
				}else
				{
					$breadcrumbs = $this->breadcrumbs_m->getBreadcrumb($id);
					if(count($breadcrumbs) > 0)
					{
						if($this->breadcrumbs_m->save($data, $id))
						{
							$content = array(
								'id'		=> $id,
								'error'		=> 0,
								'key'		=> $breadcrumbs->key,
								'title'		=> $data['title'],
								'module'	=> 'breadcrumbs',
								'control'	=> 'breadcrumbs',
								'method'	=> 'index',
								'content'	=> '{module:breadcrumbs/index,'.$id.'}'
							);
						}else
						{
							$content = array(
								'error' => 1,
								'content' => lang('breadcrumbs_admin_setting_edit_error_msg'),
							);
						}
					}else
					{
						$content = array(
							'error' => 1,
							'content' => lang('breadcrumbs_admin_setting_edit_not_found_error_msg'),
						);
					}
				}
			}else
			{
				$content = array(
					'error' => 1,
					'content' => strip_tags(validation_errors()),
				);
			}
			echo json_encode($content);
		}
		exit;
	}
	
	public function remove($id = '')
	{
		if($this->input->post('type') == 'ajax')
		{
			$this->breadcrumbs_m->delete($id);
			$this->index();
		}
	}
}