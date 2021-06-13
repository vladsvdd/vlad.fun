<?php

namespace MyProject\Controllers;

use MyProject\Exceptions\ForbiddenException;
use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Exceptions\NotFoundException;
use MyProject\Exceptions\UnauthorizedException;
use MyProject\Models\Comments\Comment;

class CommentsController extends AbstractController
{
	public function show(int $idArticle)
	{
		return Comment::findAllByCollumn('article_id', $idArticle);
	}

	public function add()
	{
		if ($this->user === null) {
			throw new UnauthorizedException();
		}

		if (!empty($_POST)) {
			try {
				$comment = Comment::createFromArray($_POST, $this->user,);
			} catch (InvalidArgumentException $exception) {
				$this->view->renderHtml('errors/commentsError.php', ['articleId' => $_POST['articleId'], 'error' => $exception->getMessage()], 404);
				return;
			}
			header('Location: /articles/' . $_POST['articleId'] . '#comment' . $comment->getId(), true, 302);
			exit();
		} else {
			$this->view->renderHtml('errors/404.php');
		}
	}

	public function edit(int $idComment): void
	{
		$comment = Comment::getById($idComment);

		if ($comment === null) {
			throw new NotFoundException();
		}
		if ($this->user === null) {
			throw new UnauthorizedException();
		}
		if (!$this->user->isAdmin()) {
			throw new ForbiddenException();
		}

		if (!empty($_POST)) {
			try {
				$comment->updateFromArray($_POST);
			} catch (InvalidArgumentException $exception) {
				$this->view->renderHtml('comments/edit.php', ['error' => $exception->getMessage(), 'comment' => $comment]);
				return;
			}

			header('Location: /admin/comments/1', true, 302);
			exit();
		}

		$this->view->renderHtml('comments/edit.php', ['comment' => $comment]);
	}
}