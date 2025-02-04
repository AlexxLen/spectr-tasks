<?php

declare(strict_types=1);

abstract class Figure
{
	private string $name;

	public function __construct(string $type)
	{
		$this->name = $type;
	}

	public function getName(): string
	{
		return $this->name;
	}

	abstract public function getArea(): float;

	abstract public function getPerimeter(): float;

}

class Square extends Figure
{
	public function __construct(private float $side)
	{
		parent::__construct('square');
	}

	public function getArea(): float
	{
		return $this->side ** 2;
	}

	public function getPerimeter(): float
	{
		return 4 * $this->side;
	}
}

class Triangle extends Figure
{

	public function __construct(
		private float $side1,
		private float $side2,
		private float $side3,
	)
	{
		parent::__construct('triangle');

	}

	public static function isValid(float $side1, float $side2, float $side3): bool
	{
		return ($side1 + $side2 > $side3) &&
			($side1 + $side3 > $side2) &&
			($side2 + $side3 > $side1);
	}

	public function getArea(): float
	{
		$s = $this->getPerimeter() / 2;
		return sqrt($s * ($s - $this->side1) * ($s - $this->side2) * ($s - $this->side3));
	}

	public function getPerimeter(): float
	{
		return $this->side1 + $this->side2 + $this->side3;
	}

}

class Circle extends Figure
{
	public function __construct(private float $radius)
	{
		parent::__construct('circle');
	}

	public function getArea(): float
	{
		return pi() * $this->radius ** 2;
	}

	public function getPerimeter(): float
	{
		return 2 * pi() * $this->radius;
	}
}



