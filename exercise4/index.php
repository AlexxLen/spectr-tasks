<?php

require_once __DIR__ . '/figure_classes.php';

header('Content-type: application/json');

$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];
$data = json_decode(file_get_contents('php://input'), true);

if ($uri !== '/api/figures' || $method !== 'POST') {
	http_response_code(405);
	echo json_encode(['error' => 'Method not allowed']);
	exit;
}


$figure = $data['figure'] ?? null;
$method = $data['method'] ?? null;
$params = $data['params'] ?? null;

if (!($figure || $method || $params)) {
	http_response_code(400);
	echo json_encode(['error' => 'Missing requires fields']);
	exit;
}

$result = null;

try {

	switch ($figure) {
		case 'square':
			$side = $params['side'] ?? null;

			if (!$side || !is_numeric($side) || $side <= 0) {
				throw new InvalidArgumentException('Invalid side length for square');
			}

			$square = new Square($side);

			if ($method === 'area') {
				$result = $square->getArea();
			} elseif ($method === 'perimeter') {
				$result = $square->getPerimeter();
			} else {
				throw new InvalidArgumentException('Invalid method for square');
			}

			break;
		case 'triangle':
			$side1 = $params['side1'] ?? null;
			$side2 = $params['side2'] ?? null;
			$side3 = $params['side3'] ?? null;

			if (
				!$side1 || !$side2 || !$side3 ||
				!is_numeric($side1) || !is_numeric($side2) || !is_numeric($side3) ||
				$side1 <= 0 || $side2 <= 0 || $side3 <= 0 ||
				!Triangle::isValid($side1, $side2, $side3)
			) {
				throw new InvalidArgumentException('Invalid side lengths for triangle');
			}

			$triangle = new Triangle($side1, $side2, $side3);

			if ($method === 'area') {
				$result = $triangle->getArea();
			} elseif ($method === 'perimeter') {
				$result = $triangle->getPerimeter();
			} else {
				throw new InvalidArgumentException('Invalid method for triangle');
			}

			break;
		case 'circle':
			$radius = $params['radius'] ?? null;

			if (!$radius || !is_numeric($radius) || $radius <= 0) {
				throw new InvalidArgumentException('Invalid radius length for circle');
			}

			$circle = new Circle($radius);

			if ($method === 'area') {
				$result = $circle->getArea();
			} elseif ($method === 'perimeter') {
				$result = $circle->getPerimeter();
			} else {
				throw new InvalidArgumentException('Invalid method for circle');
			}

			break;

		default:
			throw new InvalidArgumentException('Invalid figure');
	}

	if ($result) {
		echo json_encode(['result' => $result]);
	}

} catch (InvalidArgumentException $e) {
	http_response_code(400);
	echo json_encode(['error' => $e->getMessage()]);
} catch (Exception $e) {
	http_response_code(500);
	echo json_encode(['error' => 'Internal server error']);
}


