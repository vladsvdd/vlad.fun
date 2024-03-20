<?php

namespace MyProject\Models\Comments;

use MyProject\Controllers\CommentsController;
use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Models\ActiveRecordEntity;
use MyProject\Models\Articles\Article;
use MyProject\Models\Users\User;
use MyProject\Services\Db;

class Comment extends ActiveRecordEntity
{
	protected $authorId;
	protected $articleId;
	protected $text;
	protected $createdAt;

	public static function getNameTable(): string
	{
		return 'comments';
	}

	/**
	 * @return mixed
	 */
	public function getText()
	{
		return $this->text;
	}

	/**
	 * @param mixed $text
	 */
	public function setText($text): void
	{
		$this->text = $text;
	}

	/**
	 * @return mixed
	 */
	public function getArticleId()
	{
		return $this->article_id;
	}

	/**
	 * @param mixed $articleId
	 */
	public function setArticleId($articleId): void
	{
		$this->articleId = $articleId;
	}

	/**
	 * @return mixed
	 */
	public function getCreatedAt()
	{
		return $this->createdAt;
	}

	/**
	 * @param mixed $createdAt
	 */
	public function setCreatedAt($createdAt): void
	{
		$this->createdAt = $createdAt;
	}

	/**
	 * @param mixed $authorId
	 */
	public function setAuthorId($author): void
	{
		$this->authorId = $author;
	}

	/**
	 * @return mixed
	 */
	public function getAuthor(): User
	{
		return User::getById($this->authorId);
	}

	public static function findAllByCollumn(string $columnName, string $value)
	{
		$db = Db::getInstance();

		$result = $db->query(
			'SELECT * FROM `' . static::getNameTable() . '` WHERE `' . $columnName . '` = :value;',
			[':value' => $value],
			static::class
		);

		if ($result === []) {
			return null;
		}
		return $result;
	}

	public static function createFromArray(array $fields, User $author): Comment
	{
		if (empty($fields['text'])) {
			throw new InvalidArgumentException('Не передан текст статьи');
		}

		$comment = new Comment();

		$comment->setAuthorId($author->getId());
		$comment->setArticleId($fields['articleId']);
		$comment->setText($fields['text']);

		$comment->save();

		return $comment;
	}

	public static function findLast5Comments(int $limit): array
	{
		$db = Db::getInstance();
		$countShow = 5;
		$offset = $limit - 5;
		return $db->query('SELECT * FROM `' . static::getNameTable() . '` ORDER BY created_at DESC LIMIT ' . $countShow . ' OFFSET ' . $offset, [], static::class) ?? [];
	}

	public function updateFromArray(array $fields): Comment
	{
		if (empty($fields['text'])) {
			throw new InvalidArgumentException('Не перед текст комментария');
		}

		$this->setText($fields['text']);

		$this->save();

		return $this;

	}
}