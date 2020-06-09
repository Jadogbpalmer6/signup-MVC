<?php

/*
 *this is the main PHP file to carry out all ROUTING of the project

 *feel free to call it ROUTER

*/

//it includes the controll file
require_once './controllers/controller.php';

//instatiation of the controller class
$myController = new Controller;

if (empty($_GET['action'])) {
	$myController->display_main_page();
}
else{
	// ???? security issue and varnelabillity 
	//it would be better to use tokens 
	//i know this is insane but reka nkoreshe gutya byanonaha tu
	#next study field
	$action = $_GET['action'];

	switch ($action) {
		case 'register':
			$myController->register_user(); 
			break;
		
		default:
			# code...
			break;
	}
}
