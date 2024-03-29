<?php

namespace MyProject\Services;

require_once __DIR__ . '/../../../vendor/autoload.php';

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
        $mail->Host = '';
        $mail->Port = 465;
        $mail->Username = '';
        $mail->Password = '';
        // От кого
        $mail->setFrom('huntinghardware@gmail.com', 'stukalov.blog');
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

		try {
			$mail->send();
			return ['The email message was sent.'];
		} catch (Exception $e) {
			return ['error' => 'Mailer Error: ' . $mail->ErrorInfo];
		}
	}
}