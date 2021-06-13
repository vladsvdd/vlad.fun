<?php

namespace MyProject\Controllers;

use MyProject\Models\Users\User;
use MyProject\Services\UsersAuthService;
use MyProject\Views\View;

abstract class AbstractController
{
	protected View $view;

	protected $user;
	protected $article;

	public function __construct()
	{
		$this->user = UsersAuthService::getUserByToken();
		$this->view = new View('/../../../templates');
		$this->view->setVar('user', $this->user);
	}
}