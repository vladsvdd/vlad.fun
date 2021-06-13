<?php

namespace MyProject\Controllers;

use MyProject\Exceptions\ForbiddenException;
use MyProject\Exceptions\UnauthorizedException;
use MyProject\Models\Articles\Article;
use MyProject\Models\Comments\Comment;

class AdminController extends AbstractController
{
	public function view(int $page = 1)
	{
		if ($this->user === null) {
			throw new UnauthorizedException();
		}
		if (!$this->user->isAdmin()) {
			throw new ForbiddenException();
		}
		if (preg_match('~^admin/view/(\d+)$~', $_GET['route'], $number)) {
			$page = $number[1];
			if ($page == 0) {
				$page = 1;
			}
		}
		$countAllArticles = count(Article::findAll());
		$countPages = ceil($countAllArticles / 5);
		$articles = Article::findLast5Article(5 * $page);
		if (count($articles) === 0) {
			$articles = Article::findLast5Article(5 * $countPages);
			$this->view->renderHtml('admin/view.php',
				['articles' => $articles, 'countPages' => $countPages, 'page' => (int)$countPages]);
		} else {
			$this->view->renderHtml('admin/view.php',
				['articles' => $articles, 'countPages' => $countPages, 'page' => (int)$page]);
		}
	}

	public function viewComments(int $page = 1)
	{
		if ($this->user === null) {
			throw new UnauthorizedException();
		}
		if (!$this->user->isAdmin()) {
			throw new ForbiddenException();
		}
		if (preg_match('~^admin/comments/(\d+)$~', $_GET['route'], $number)) {
			$page = $number[1];
			if ($page == 0) {
				$page = 1;
			}
		}
		$countAllComments = count(Comment::findAll());
		$countPages = ceil($countAllComments / 5);
		$comments = Comment::findLast5Comments(5 * $page);
		if (count($comments) === 0) {
			$comments = Comment::findLast5Comments(5 * $countPages);
			$this->view->renderHtml('admin/viewComments.php',
				['comments' => $comments, 'countPages' => $countPages,
					'countAllComments' => $countAllComments, 'page' => (int)$countPages]);
		} else {
			$this->view->renderHtml('admin/viewComments.php',
				['comments' => $comments, 'countPages' => $countPages,
					'countAllComments' => $countAllComments, 'page' => (int)$page]);
		}
	}
}