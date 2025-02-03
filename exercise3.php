<?php

declare(strict_types=1);

$startTime = microtime(true);
$startMemory = memory_get_usage();

$prefix = 'con';
$arr = [
	'clinic', 'contract', 'abstract', 'public', 'consumer', 'test', 'contributor', 'concat', 'cat'
];


$result = filterStringsByPrefix($prefix, $arr);

var_dump($result);

$endTime = microtime(true);
$endMemory = memory_get_usage();

$executionTime = $endTime - $startTime;
$memoryUsage = $endMemory - $startMemory;

echo 'Execution time: ' . $executionTime . ' seconds' . PHP_EOL;
echo 'Memory usage: ' . $memoryUsage . 'bites' . PHP_EOL;

function filterStringsByPrefix(string $prefix, array $arr): array
{
	return array_filter($arr, function ($item) use ($prefix) {
		return strpos($item, $prefix) === 0;
	});
}

