<?php
function dateFormat(string $objectDate): string
{
	$input = explode(' ', $objectDate);

	/*
	 * Форматирую дату типа ДД:ММ:ГГГГ
	 */
	$date = explode('-', $input[0]);
	$date = implode('.', array_reverse($date));

	/*
	 * удаляю секунды
	 */
	$time = $input[1];
	$positionSecond = strrpos($time, ':');
	$time = substr($time, 0, $positionSecond);

    return $date . ' в ' . $time;
}