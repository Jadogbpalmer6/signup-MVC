<?php
$Router= new Router;

/* #####################################33333
iyi function cg method yitwa **addroute** igomba kugira parameters ebyiri(2)
parameter ya 1 ni routepath
parameter ya 2 ni controllername  iko ngera ikaba na class
@ igaragaza method izaba called igihe route izaba ibaye mounted iyo @ idahari default method iba ari index();

*/

$Router -> addroute('/','HomeController');
$Router -> addroute('/signup','adduser');
$Router -> addroute('/login', 'login');
$Router -> addroute('/todo', 'todo');
$Router -> addroute('/add', 'todo@addTask');
$Router -> addroute('/end', 'todo@EndTask');

//$Router->addroute('/foo','foo@methodname');
// 

 ?>
