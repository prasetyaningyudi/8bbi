<?php

$roles = array(
			'' => array (
				'report' => array ('index', 'list'),
			),
			'administrator' => array (
				'assignmenu' => array ('index', 'list', 'insert', 'update', 'delete'),
				'menu' => array ('index', 'list', 'insert', 'update', 'update_status', 'delete', 'detail', 'modal_form', 'modal_table', 'data_form'),
				'user' => array ('index', 'list', 'insert', 'update', 'update_status', 'delete', 'detail', 'm_form_user_info', 'insert_user_info', 'm_user_info'),
				'role' => array ('index', 'list', 'insert', 'update', 'update_status', 'detail'),
				'app_data' => array ('index', 'list', 'insert', 'update', 'update_status', 'delete', 'detail'),							
			),		
		);


