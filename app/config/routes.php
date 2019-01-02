<?php

$route['default'] = 'home';
$route['error'] = 'home/error';


$route['admin/email-templates/edit/:num'] = 'admin/editEmailTemplate/$1';
$route['admin/email-templates'] = 'admin/emailTemplates';

