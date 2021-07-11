<?php

namespace MyProject\Controllers;

use MyProject\Exceptions\ForbiddenException;
use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Exceptions\NotFoundException;
use MyProject\Exceptions\UnauthorizedException;
use MyProject\Models\Articles\Article;
use MyProject\Models\Comments\Comment;
use MyProject\Models\Users\User;
use MyProject\Views\View;

class ArticlesController extends AbstractController
{
	private $comments;
	public function view(int $idArticle, int $page = 1)
	{
		/**
		 * получаю статьи
		 */
		$article = Article::getById($idArticle);

		$this->comments = new CommentsController();
		$comment = $this->comments->show($idArticle);

		$popularArticles = Article::findPopularArticle();
		$articlesNew = Article::findLast5Article(5 * $page);

		if ($article === null) {
			throw new NotFoundException();
		}
		/*
		 * загружаю страницу view пользователю
		 */
		$this->view->renderHtml('articles/view.php',
			[
				'article' => $article,
				'comments' => $comment,
				'popularArticles' => $popularArticles,
				'articlesNew'=>$articlesNew
			]
		);
	}

	public function edit(int $idArticle): void
	{
		$article = Article::getById($idArticle);

		if ($article === null) {
			throw new NotFoundException();
		}
		if ($this->user === null) {
			throw new UnauthorizedException();
		}
		if (!$this->user->isAdmin()){
			throw new ForbiddenException();
		}

		if (!empty($_POST)) {
			try {
				$article->updateFromArray($_POST, $_FILES);
			} catch (InvalidArgumentException $exception) {
				$this->view->renderHtml('articles/edit.php', ['error' => $exception->getMessage(), 'article' => $article]);
				return;
			}

			header('Location: /articles/' . $article->getId(), true, 302);
			exit();
		}

		$this->view->renderHtml('articles/edit.php', ['article' => $article]);
	}

	public function add(): void
	{
		if ($this->user === null) {
			throw new UnauthorizedException();
		}
		if (!$this->user->isAdmin()) {
			throw new ForbiddenException();
		}

		if (!empty($_POST)) {
			try {
				$article = Article::createFromArray($_POST, $_FILES, $this->user);
			} catch (InvalidArgumentException $exception) {
				$this->view->renderHtml('articles/add.php', ['error' => $exception->getMessage()]);
				return;
			}
			header('Location: /', $article->getId(), 302);
			exit();
		}

		$this->view->renderHtml('articles/add.php');
	}


	public function delete(int $idArticle)
	{
		$article = Article::getById($idArticle);

		if ($article === null) {
			throw new NotFoundException();
		}
		if ($this->user === null) {
			throw new UnauthorizedException();
		}
		if (!$this->user->isAdmin()){
			throw new ForbiddenException();
		}
		if ($article === null) {
			throw new NotFoundException();
		}
		$article->delete();
	}
}