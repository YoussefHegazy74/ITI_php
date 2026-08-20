<?php

abstract class Person
{
    protected string $name;
    protected string $address;

    public function __construct(string $name, string $address)
    {
        $this->name = $name;
        $this->address = $address;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    abstract public function toString(): string;

    public function __toString(): string
    {
        return $this->toString();
    }
}

class Student extends Person
{
    private string $program;
    private int $year;
    private float $fee;

    public function __construct(string $name, string $address, string $program, int $year, float $fee)
    {
        parent::__construct($name, $address);
        $this->program = $program;
        $this->year = $year;
        $this->fee = $fee;
    }

    public function getProgram(): string
    {
        return $this->program;
    }

    public function setProgram(string $program): void
    {
        $this->program = $program;
    }

    public function getYear(): int
    {
        return $this->year;
    }

    public function setYear(int $year): void
    {
        $this->year = $year;
    }

    public function getFee(): float
    {
        return $this->fee;
    }

    public function setFee(float $fee): void
    {
        $this->fee = $fee;
    }

    public function toString(): string
    {
        return "Student[Person[name={$this->name},address={$this->address}],program={$this->program},year={$this->year},fee={$this->fee}]";
    }
}

class Staff extends Person
{
    private string $school;
    private float $pay;

    public function __construct(string $name, string $address, string $school, float $pay)
    {
        parent::__construct($name, $address);
        $this->school = $school;
        $this->pay = $pay;
    }

    public function getSchool(): string
    {
        return $this->school;
    }

    public function setSchool(string $school): void
    {
        $this->school = $school;
    }

    public function getPay(): float
    {
        return $this->pay;
    }

    public function setPay(float $pay): void
    {
        $this->pay = $pay;
    }

    public function toString(): string
    {
        return "Staff[Person[name={$this->name},address={$this->address}],school={$this->school},pay={$this->pay}]";
    }
}

// ---------------------------------------------------------

interface Shape
{
    public function getColor(): string;
    public function setColor(string $color): void;
    public function isFilled(): bool;
    public function setFilled(bool $filled): void;
    public function getArea(): float;
    public function getPerimeter(): float;
    public function toString(): string;
}

class CircleShape implements Shape
{
    private float $radius;
    private string $color;
    private bool $filled;

    public function __construct(float $radius = 1.0, string $color = "red", bool $filled = true)
    {
        $this->radius = $radius;
        $this->color = $color;
        $this->filled = $filled;
    }

    public function getRadius(): float
    {
        return $this->radius;
    }

    public function setRadius(float $radius): void
    {
        $this->radius = $radius;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function setColor(string $color): void
    {
        $this->color = $color;
    }

    public function isFilled(): bool
    {
        return $this->filled;
    }

    public function setFilled(bool $filled): void
    {
        $this->filled = $filled;
    }

    public function getArea(): float
    {
        return pi() * $this->radius * $this->radius;
    }

    public function getPerimeter(): float
    {
        return 2 * pi() * $this->radius;
    }

    public function toString(): string
    {
        $filledStr = $this->filled ? "true" : "false";
        return "Circle[Shape[color={$this->color},filled={$filledStr}],radius={$this->radius}]";
    }

    public function __toString(): string
    {
        return $this->toString();
    }
}

class RectangleShape implements Shape
{
    protected float $width;
    protected float $length;
    private string $color;
    private bool $filled;

    public function __construct(float $width = 1.0, float $length = 1.0, string $color = "red", bool $filled = true)
    {
        $this->width = $width;
        $this->length = $length;
        $this->color = $color;
        $this->filled = $filled;
    }

    public function getWidth(): float
    {
        return $this->width;
    }

    public function setWidth(float $width): void
    {
        $this->width = $width;
    }

    public function getLength(): float
    {
        return $this->length;
    }

    public function setLength(float $length): void
    {
        $this->length = $length;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function setColor(string $color): void
    {
        $this->color = $color;
    }

    public function isFilled(): bool
    {
        return $this->filled;
    }

    public function setFilled(bool $filled): void
    {
        $this->filled = $filled;
    }

    public function getArea(): float
    {
        return $this->width * $this->length;
    }

    public function getPerimeter(): float
    {
        return 2 * ($this->width + $this->length);
    }

    public function toString(): string
    {
        $filledStr = $this->filled ? "true" : "false";
        return "Rectangle[Shape[color={$this->color},filled={$filledStr}],width={$this->width},length={$this->length}]";
    }

    public function __toString(): string
    {
        return $this->toString();
    }
}

class Square extends RectangleShape
{
    public function __construct(float $side = 1.0, string $color = "red", bool $filled = true)
    {
        parent::__construct($side, $side, $color, $filled);
    }

    public function getSide(): float
    {
        return $this->getWidth();
    }

    public function setSide(float $side): void
    {
        $this->width = $side;
        $this->length = $side;
    }

    public function setWidth(float $side): void
    {
        $this->setSide($side);
    }

    public function setLength(float $side): void
    {
        $this->setSide($side);
    }

    public function toString(): string
    {
        return "Square[Rectangle[" . parent::toString() . "]]";
    }
}
