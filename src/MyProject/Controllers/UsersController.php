<?php

namespace MyProject\Controllers;

use MyProject\Exceptions\ActivateException;
use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Exceptions\UnauthorizedException;
use MyProject\Models\Users\User;
use MyProject\Models\Users\UserActivationService;
use MyProject\Services\EmailSender;
use MyProject\Services\Upload;
use MyProject\Services\UsersAuthService;
use MyProject\Views\View;

class UsersController extends AbstractController
{
	public function signUp()
	{
		if (!empty($_POST)) {
			try {
				$user = User::signUp($_POST);
			} catch (InvalidArgumentException $exception) {
				$this->view->renderHtml('users/signUp.php', ['error' => $exception->getMessage()]);
				return;
			}
			if ($user instanceof User) {
				$code = UserActivationService::createActivationCode($user);

				$reuslt = EmailSender::send($user, 'Activation', 'userActivation.php',
					[
						'userId' => $user->getId(),
						'code' => $code
					]
				);

				$this->view->renderHtml('users/signUpSuccessful.php',
					['result' => $reuslt]
				);
				return;
			}
		}
		$this->view->renderHtml('users/signUp.php');
	}

	public function activate(int $userId, string $activationCode): void
	{
		try {
			$user = User::getById($userId);
			if (empty($user)) {
				throw new ActivateException('Пользователь не найден!');
			}
			if ($user->isConfirmed() === 1) {
				throw new ActivateException('Учетная запись уже активирована.');
			}
			$isCodeValid = UserActivationService::checkActivationCode($user, $activationCode);

			if ($isCodeValid === false) {
				throw new ActivateException('Код активации не найден.');
			}

			/* Активация */
			$user->activate();
			/* удаление кода активации */
			UserActivationService::deleteActivationCode($user);
			$this->view->renderHtml('mail/activationSuccess.php',
				['message' => 'Ваша учетная запись активирована!']);

		} catch (ActivateException $exception) {
			$this->view->renderHtml('errors/activationErrors.php',
				['error' => $exception->getMessage()], 422);
		}
	}

	public function login()
	{
		if (!empty($_POST)) {
			try {
				$user = User::login($_POST);
				UsersAuthService::createToken($user);
				header('Location: /');
				exit();
			} catch (InvalidArgumentException $exception) {
				$this->view->renderHtml('users/login.php', ['error' => $exception->getMessage()]);
				return;
			}
		}
		$this->view->renderHtml('users/login.php');
	}

	public function logout()
	{
		setcookie('token', '', -1, '/', '', false, true);
		header('Location: /');
	}

	public function profile()
	{
		if ($this->user === null) {
			throw new UnauthorizedException();
		}
		if (!empty($_POST)) {
			/*
			 * Задаем новый пароль
			 */
			if (!empty($_POST['changePassword'])) {
				try {
					$user = User::changePassword($_POST, $this->user);
				} catch (InvalidArgumentException $exception) {
					$this->view->renderHtml('users/profile.php', ['error' => $exception->getMessage()], 404);
					return;
				}
				$this->view->renderHtml('users/profile.php', ['successChangePassword' => true]);
			} /*
			 * загружаем фото пользователя
			 */
			elseif (!empty($_POST['changePhoto']) && !empty($_FILES)) {
				try {
					$user = User::changePhoto($_FILES, $this->user);
				} catch (InvalidArgumentException $exception) {
					$this->view->renderHtml('users/profile.php', ['error' => $exception->getMessage()], 404);
					return;
				}
				$this->view->renderHtml('users/profile.php', ['photo' => $user->getPhoto()]);
			}
		} else {
			$this->view->renderHtml('users/profile.php');
		}
	}
}