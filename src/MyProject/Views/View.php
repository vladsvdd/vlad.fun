<?php

namespace MyProject\Views;

class View
{
	private string $templatesPath;

	private array $extraVars = [];

	public function __construct(string $templatesPath)
	{
		$this->templatesPath = $templatesPath;
	}

	public function setVar(string $name, $value): void
	{
		$this->extraVars[$name] = $value;
	}

	public function renderHtml(string $templateName, array $vars = [], int $code = 200)
	{

		http_response_code($code);

		extract($this->extraVars);
		extract($vars);
		/*
		 * записываю в буфер вывод шаблона
		 */
		ob_start();
		include __DIR__ . $this->templatesPath . '/' . $templateName;
		$buffer = ob_get_contents();
		ob_end_clean();

		echo $buffer;
	}
}