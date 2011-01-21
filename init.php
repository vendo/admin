<?php
/**
 * Init file for admin module, add routes
 *
 * @package   Vendo
 * @author    Jeremy Bush <contractfrombelow@gmail.com>
 * @copyright (c) 2010-2011 Jeremy Bush
 * @license   ISC License http://github.com/zombor/Vendo/raw/master/LICENSE
 */

Route::set(
	'admin panel',
	'admin/index.html'
)->defaults(
	array(
		'controller' => 'admin',
		'action' => 'index',
	)
);

Route::set(
	'actions',
	'admin/<controller>/<action>.html',
	array(
		'action' => 'add|edit|delete|index|view',
		'controller' => 'user|order|address|contact',
	)
)->defaults(
	array(
		'controller' => 'user',
		'action' => 'index',
	)
);