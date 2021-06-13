<?php

namespace MyProject\Controllers;

use MyProject\Models\Articles\Article;

class AboutController extends AbstractController
{
	public function about()
	{
		/**
		 * получаю статьи
		 */
		$articlesNew = Article::findLast5Article(5);

		/*
		 * загружаю страницу view пользователю
		 */
		$this->view->renderHtml('otherPages/about.php',
			[
				'articlesNew'=>$articlesNew
			]
		);
	}
}