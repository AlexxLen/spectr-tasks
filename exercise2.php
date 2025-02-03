<?php

declare(strict_types=1);

$data = [
	'cities' => [
		[
			[
				'name' => 'Пермь',
				'sort' => 400,
				'nested' => [
					'level1' => [
						'level2' => 'nested string',
						'is_test' => true
					]
				]
			],
			[
				'name' => 'Омск',
				'sort' => 500
			],
			[
				'name' => 'Москва',
				'sort' => 50
			],
			453,
			'Piter'
		],
		'NewYork',
		59
	],
	'fruit',
	'numbers' => [1, 'two', 'three', false],
	true,
];


$strings = extractStrings($data);

var_dump($strings);

function extractStrings(array $arr): array
{
	$strings = [];
	foreach ($arr as $item) {
		if (is_string($item)) {
			$strings[] = $item;
		} elseif (is_array($item)) {
			$strings = array_merge($strings, extractStrings($item));
		}
	}

	return $strings;
}

