<?php 

/*

4 Задание
Написать функцию, которая будет принимать 3 параметра

Любой вложенности массив (array) = $datas
Что ищем (string) = $key
На что заменяем (string) = $value
На выходе мы должны получить массив $datas в котором заменены все элементы (ключи, значения) $key на $value. Будет + если решите задачу без использования циклов.

Например:

	$datas = [
		'aasd' => 'bbsr',
		'aas' => [
			'zzc' => 'ffts'
		]
	];

	$key = 's';
	$value = '%SUPER%';

	$datas = str_replace_array($datas, $key, $value);

	print_r($datas);

	<<< Результат:

	(array) [
		'aa%SUPER%d' => 'bb%SUPER%r',
		'aa%SUPER%' => [
			'zzc' => 'fft%SUPER%'
		]
	];

*/

/**
 * Функция которая меняет рекурсивно  ключи  и значения ..  в массиве ..
 * @param  array $arr  [description]
 * @param  string $from Искомая строка 
 * @param  string $to   Строка замены
 * @return array       Результат замен
 */
function transform(array $arr,string $from, string $to):array
{
	$newarr=[];
	array_walk($arr, function ($v,$k,&$arr) use ($from,$to,&$newarr) {
		if (strpos($k, $from)!==false)
			$k=str_replace($from, $to, $k);
		if (is_array($v))
			$newarr[$k]=transform($v,$from,$to);
		else
		{
			if (strpos($v, $from)!==false)
				$v=str_replace($from, $to, $v);
			$newarr[$k]=$v;
		}

	},$newarr);
	return $newarr;
}

$datas = [
	'aasd' => 'bbsr',
	'aas' => [
		'zsc' => ['ffts']
	]
];

print_r($datas);


print_r(transform($datas,'s','%SUPER%'));

