<?php

declare(strict_types=1);

$prefix = 'con';
$arr = [
	'clinic', 'contract', 'abstract', 'public', 'consumer', 'test', 'contributor', 'concat', 'cat'
];


$result = filterStringsByPrefix($prefix, $arr);

var_dump($result);

function filterStringsByPrefix(string $prefix, array $arr): array
{
	$result = [];

	foreach ($arr as $item) {
		if (preg_match("/{$prefix}/", $item)) {
			$result[] = $item;
		}
	}
	return $result;
}

