<?php

namespace MyProject\Services;

require_once __DIR__ . '/../library/vendor/autoload.php';

use MyProject\Models\Users\User;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EmailSender
{
	public static function send(
		User $receiver,
		string $subject,
		string $templateName,
		array $templateVars = []
	): array
	{
		extract($templateVars);
		ob_start();
		require __DIR__ . '/../../../templates/mail/' . $templateName;
		$body = ob_get_contents();
		ob_end_clean();

		$mail = new PHPMailer();
		$mail->CharSet = 'UTF-8';
		// Настройки SMTP
		$mail->isSMTP();
		$mail->SMTPAuth = true;
		$mail->SMTPDebug = 0;
		$mail->Host = 'ssl://smtp.jino.ru';
		$mail->Port = 465;
		$mail->Username = 'help@vlad.fun';
		$mail->Password = 'R9N9v82X7njDcyG';
		// От кого
		$mail->setFrom('help@vlad.fun', 'vlad.fun');
		// Кому
		try {
			$mail->addAddress($receiver->getEmail(), $receiver->getNickname());
		} catch (Exception $e) {
			return ['error' => 'Mailer Error: ' . $e];
		}
		$mail->isHTML(true);
		// Тема письма
		$mail->Subject = $subject;
		// Тело письма
		$mail->msgHTML($body);

		// Приложение
//		$mail->addAttachment(__DIR__ . '/image.jpg');

		try {
			$mail->send();
			return ['The email message was sent.'];
		} catch (Exception $e) {
			return ['error' => 'Mailer Error: ' . $mail->ErrorInfo];
		}


		/*$success = mail($receiver->getEmail(), $subject, $body, 'Content-Type: text/html; charset=UTF-8');
		if (!$success) {
			return 'Возникла ошибка при отправке письма! ' . $errorMessage = error_get_last()['message'] .
					'. Обратитесь к администратору сайта.';
		}
		return '';*/
	}
}