<?php

declare(strict_types=1);

$cities = [
	[
		'name' => 'Пермь',
		'sort' => 400,
	],
	[
		'name' => 'Омск',
		'sort' => 500
	],
	[
		'name' => 'Москва',
		'sort' => 50
	],
	[
		'name' => 'Екатеринбург',
		'sort' => 50
	],
	[
		'name' => 'Сочи',
		'sort' => 300
	],
];


$sortedCities = sortCities($cities);

var_dump($sortedCities);

function sortCities(array $cities): array
{
	usort($cities, function ($a, $b) {
		if ($a['sort'] === $b['sort']) {
			return strcmp($a['name'], $b['name']);
		}

		return $a['sort'] <=> $b['sort'];
	});
	return $cities;
}

