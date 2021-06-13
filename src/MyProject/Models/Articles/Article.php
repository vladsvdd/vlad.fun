<?php

namespace MyProject\Models\Articles;

use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Models\ActiveRecordEntity;
use MyProject\Models\Users\User;
use MyProject\Services\Db;
use MyProject\Services\Upload;
use MyProject\Services\UsersAuthService;

class Article extends ActiveRecordEntity
{
	protected int $authorId;
	protected string $name;
	protected string $text;
	protected string $createdAt;
	protected string $theme;
	protected string $photo;

	/**
	 * @return string
	 */
	public function getName(): string
	{
		return $this->name;
	}

	/**
	 * @param string $name
	 */
	public function setName(string $name): void
	{
		$this->name = $name;
	}

	/**
	 * @return string
	 */
	public function getText(): string
	{
		return $this->text;
	}

	/**
	 * @param string $text
	 */
	public function setText(string $text): void
	{
		$this->text = $text;
	}

	/**
	 * @return User
	 * LazyLoad ленивая загрузка. Данные по автору загрузятся по запросу
	 */
	public function getAuthor(): User
	{
		return User::getById($this->authorId);
	}

	/**
	 * @param User $author
	 */
	public function setAuthor(User $author): void
	{
		$this->authorId = $author->getId();
	}

	/**
	 * @return string
	 */
	public function getCreatedAt(): string
	{
		return $this->createdAt;
	}

	/**
	 * @param string $createdAt
	 */
	public function setCreatedAt(string $createdAt)
	{
		$this->createdAt = $createdAt;
	}

	/**
	 * @return string
	 */
	public function getTheme(): string
	{
		return $this->theme;
	}

	/**
	 * @param string $theme
	 */
	public function setTheme(string $theme): void
	{
		$this->theme = $theme;
	}

	/**
	 * @param string $photo
	 */
	public function setPhoto(string $photo): void
	{
		$this->photo = $photo;
	}

	/**
	 * @return string
	 */
	public function getPhoto(): string
	{
		return $this->photo;
	}

	/*
	 * Передаю в запрос в модели родителя ActiveRecordEntity название таблицы
	 */
	protected static function getNameTable(): string
	{
		return 'articles';
	}

	public static function createFromArray(array $fields, $file, User $author): Article
	{
		if (empty($fields['name'])) {
			throw new InvalidArgumentException('Не передано название статьи');
		}
		if (empty($fields['text'])) {
			throw new InvalidArgumentException('Не передан текст статьи');
		}
		if (empty($fields['theme'])) {
			throw new InvalidArgumentException('Не передана тема статьи');
		}
		if (empty($file['photo'])) {
			throw new InvalidArgumentException('Не передано фото статьи');
		}

		$article = new Article();
		/*
		 * проверка загружаемой картинки
		 */
		$result = Upload::checkPhoto($file, $author->getNickname());

		if ($result['error']) {
			throw new InvalidArgumentException($result['error']);
		} elseif ($result['result']) {

			$article->setAuthor($author);
			$article->setName($fields['name']);
			$article->setText($fields['text']);
			$article->setTheme($fields['theme']);
			$article->setPhoto($result['result']);

			$article->save();
		}
		return $article;
	}

	public function updateFromArray(array $fields, array $files = []): Article
	{
		if (empty($fields['name'])) {
			throw new InvalidArgumentException('Не передано название статьи');
		}
		if (empty($fields['text'])) {
			throw new InvalidArgumentException('Не передан текст статьи');
		}
		if (empty($fields['theme'])) {
			throw new InvalidArgumentException('Не передана тема статьи');
		}

		$this->setName($fields['name']);
		$this->setText($fields['text']);
		$this->setTheme($fields['theme']);
		if (!empty($files) && empty($files['photo']['error'])) {
			/*
		 * проверка загружаемой картинки
		 */
			$result = Upload::checkPhoto($files, 'test');

			if ($result['error']) {
				throw new InvalidArgumentException($result['error']);
			}
			$this->setPhoto($result['result']);
		}

		$this->save();

		return $this;

	}

	public static function findLast5Article(int $limit): array
	{
		$db = Db::getInstance();
		$countShow = 5;
		$offset = $limit - 5;
		return $db->query('SELECT * FROM `' . static::getNameTable() . '` ORDER BY created_at DESC LIMIT ' . $countShow . ' OFFSET ' . $offset, [], static::class);
	}

	public static function findPopularArticle(): array
	{
		$db = Db::getInstance();
		$popularComment = $db->query('SELECT article_id, COUNT(article_id) FROM `comments` GROUP BY article_id ORDER BY `COUNT(article_id)` DESC');

		$columns = [];
		$paramsNames = [];
		$params2values = [];
		$i = 0;
		foreach ($popularComment as $columnName => $value) {
			foreach ($value as $item) {

				$paramName = ':' . 'article_id' . $i;
				$columns[] = 'id = ' . $paramName;
				$params2values[$paramName] = $item;
				$i++;
				break;
			}
		}
		$columnsToSql = implode(' OR ', $columns);

		$sql = 'SELECT * FROM `' . static::getNameTable() . '` WHERE ' . $columnsToSql;

		$popularArticle = $db->query($sql, $params2values, static::class);
		return $popularArticle;
	}
}