<?php

namespace MyProject\Models;

use MyProject\Services\Db;

abstract class ActiveRecordEntity
{
	protected int $id;

	/**
	 * @return int
	 */
	public function getId(): int
	{
		return $this->id;
	}

	/**
	 * @param $name
	 * @param $value
	 * Изменяю пришедшие названия свойств таблицы на заданные выше имена свойств
	 */
	public function __set($name, $value)
	{
		$camelCase = $this->underscoreToCamelCase($name);
		$this->$camelCase = $value;
	}

	/**
	 * @param string $source
	 * @return string
	 * Поля таблицы типа $atricle_id привожу к виду $articleId
	 */
	private function underscoreToCamelCase(string $source): string
	{
		/*
		 * Преобразовать первую букву каждого слова в верхний регистр
		 */
		$firstLetterInWordsUpRegister = ucwords($source, '_');
		/*
		 * Заменить нижнее подчеркивание
		 */
		$replaceSimbol = str_replace('_', '', $firstLetterInWordsUpRegister);
		/*
		 * Первую букву преобразовать в нижний регистр
		 */
		return lcfirst($replaceSimbol);
	}

	/**
	 * @return string
	 */
	abstract protected static function getNameTable(): string;

	/**
	 * @param int $id
	 * @return static|null
	 * Получаю объект нужной таблицы
	 * в static::class автоматически подставится класс, в котором этот метод определен. Это позднее статическое
	 * связывание. код, который будет зависеть от класса, в котором он вызывается, а не в котором он описан
	 */
	public static function getById(int $id): ?self
	{
		$db = Db::getInstance();
		$entities = $db->query(
			'SELECT * FROM `' . static::getNameTable() . '` WHERE id =:id;',
			[':id' => $id],
			static::class
		);
		return $entities ? $entities[0] : null;
	}

	/**
	 * @return array
	 * Получаю всю таблицу объектом через статическое связывание static::class
	 * код, будет зависеть от класса, в котором он вызывается
	 */
	public static function findAll(): array
	{
		$db = Db::getInstance();
		return $db->query('SELECT * FROM `' . static::getNameTable() . '`', [], static::class);
	}

	public static function findOneByColumn(string $columnName, string $value): ?self
	{
		$db = Db::getInstance();
		$result = $db->query(
			'SELECT * FROM `' . static::getNameTable() . '` WHERE `' . $columnName . '` = :value LIMIT 1;',
			[':value' => $value],
			static::class
		);
		if ($result === []){
			return null;
		}
		return $result[0];
	}

	public function delete()
	{
		$db = Db::getInstance();
		$db->query('DELETE FROM `' . static::getNameTable() . '` WHERE id = :id',
			[':id' => $this->id]
		);
		$this->id = -1;
	}

	public function save(): void
	{
		$mappedProperties = $this->mapPropertiesToDbFormat();
		if (!empty($this->id)) {
			$this->update($mappedProperties);
		} else {
			$this->insert($mappedProperties);
		}
	}

	public function update(array $mappedProperties): void
	{
		$columns2params = [];
		$params2value = [];
		$index = 1;
		foreach ($mappedProperties as $key => $value) {
			$param = ':param' . $index;
			$columns2params[] = $key . ' = ' . $param;
			$params2value[$param] = $value;
			$index++;
		}

		$sql = 'UPDATE ' . static::getNameTable() .
			' SET ' . implode(', ', $columns2params) .
			' WHERE id = ' . $this->id;
		$db = Db::getInstance();
		$db->query($sql, $params2value, static::class);
	}

	public function insert(array $mappedProperties): void
	{
		$filteredProperties = array_filter($mappedProperties);

		$columns = [];
		$paramsNames = [];
		$params2values = [];
		foreach ($filteredProperties as $columnName => $value) {
			$columns[] = '`' . $columnName . '`';
			$paramName = ':' . $columnName;
			$paramsNames[] = $paramName;
			$params2values[$paramName] = $value;
		}

		$columnsToSql = implode(', ', $columns);
		$valueNameToSql = implode(', ', $paramsNames);

		$sql = 'INSERT INTO ' . static::getNameTable() . ' (' . $columnsToSql . ') VALUES (' . $valueNameToSql . ');';

		$db = Db::getInstance();
		$db->query($sql, $params2values, static::class);
		$this->id = $db->getLastInsertId();
	}

	private function mapPropertiesToDbFormat(): array
	{
		$reflector = new \ReflectionObject($this);
		$properties = $reflector->getProperties();

		$mappedProperties = [];
		foreach ($properties as $property) {
			$propertyName = $property->getName();
			$propertyNameAsUnderscore = $this->camelCaseToUnderscore($propertyName);
			$mappedProperties[$propertyNameAsUnderscore] = $this->$propertyName ?? null;
		}

		return $mappedProperties;
	}

	private function camelCaseToUnderscore(string $source): string
	{
		$underscrore = preg_replace('~(?<!^)[A-Z]~', '_$0', $source);
		$lettersToLowCase = strtolower($underscrore);
		return $lettersToLowCase;
	}
}