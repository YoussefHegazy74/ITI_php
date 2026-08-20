<?php


class Author
{
    private string $name;
    private string $email;
    private string $gender; 

    public function __construct(string $name, string $email, string $gender)
    {
        $this->name = $name;
        $this->email = $email;
        $this->gender = $gender;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getGender(): string
    {
        return $this->gender;
    }

    public function toString(): string
    {
        return "Author[name={$this->name},email={$this->email},gender={$this->gender}]";
    }

    public function __toString(): string
    {
        return $this->toString();
    }
}


class SingleAuthorBook
{
    private string $name;
    private Author $author;
    private float $price;
    private int $qty;

    public function __construct(string $name, Author $author, float $price, int $qty = 0)
    {
        $this->name = $name;
        $this->author = $author;
        $this->price = $price;
        $this->qty = $qty;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAuthor(): Author
    {
        return $this->author;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function getQty(): int
    {
        return $this->qty;
    }

    public function setQty(int $qty): void
    {
        $this->qty = $qty;
    }

    public function toString(): string
    {
        return "Book[name={$this->name},{$this->author->toString()},price={$this->price},qty={$this->qty}]";
    }

    public function __toString(): string
    {
        return $this->toString();
    }
}


class MultiAuthorBook
{
    private string $name;

    private array $authors;
    private float $price;
    private int $qty;

    public function __construct(string $name, array $authors, float $price, int $qty = 0)
    {
        $this->name = $name;
        $this->authors = $authors;
        $this->price = $price;
        $this->qty = $qty;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAuthors(): array
    {
        return $this->authors;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function getQty(): int
    {
        return $this->qty;
    }

    public function setQty(int $qty): void
    {
        $this->qty = $qty;
    }

    public function getAuthorNames(): string
    {
        $names = array_map(fn($author) => $author->getName(), $this->authors);
        return implode(", ", $names);
    }

    public function toString(): string
    {
        $authorsStr = implode(",", array_map(fn($a) => $a->toString(), $this->authors));
        return "Book[name={$this->name},authors={{$authorsStr}},price={$this->price},qty={$this->qty}]";
    }

    public function __toString(): string
    {
        return $this->toString();
    }
}

// --------------------------------------------------------


class SessionAuthor
{
    private string $name;
    private string $email;

    public function __construct(string $name, string $email)
    {
        $this->name = $name;
        $this->email = $email;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function toString(): string
    {
        return "Author[name={$this->name},email={$this->email}]";
    }

    public function __toString(): string
    {
        return $this->toString();
    }
}

class IsbnBook
{
    private string $isbn;
    private string $name;
    private SessionAuthor $author;
    private float $price;
    private int $qty;

    public function __construct(string $isbn, string $name, SessionAuthor $author, float $price, int $qty = 0)
    {
        $this->isbn = $isbn;
        $this->name = $name;
        $this->author = $author;
        $this->price = $price;
        $this->qty = $qty;
    }

    public function getIsbn(): string
    {
        return $this->isbn;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAuthor(): SessionAuthor
    {
        return $this->author;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function getQty(): int
    {
        return $this->qty;
    }

    public function setQty(int $qty): void
    {
        $this->qty = $qty;
    }

    public function getAuthorName(): string
    {
        return $this->author->getName();
    }

    public function toString(): string
    {
        return "Book[isbn={$this->isbn},name={$this->name},{$this->author->toString()},price={$this->price},qty={$this->qty}]";
    }

    public function __toString(): string
    {
        return $this->toString();
    }
}

// --------------------------------------------------------

trait CircleTrait
{
    private float $radius = 1.0;
    private string $color = "red";

    public function initCircle(float $radius = 1.0, string $color = "red"): void
    {
        $this->radius = $radius;
        $this->color = $color;
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

    public function getArea(): float
    {
        return pi() * $this->radius * $this->radius;
    }

    public function circleToString(): string
    {
        return "Circle[radius={$this->radius},color={$this->color}]";
    }
}

class Cylinder
{
    use CircleTrait;

    private float $height;

    public function __construct(float $radius = 1.0, float $height = 1.0, string $color = "red")
    {
        $this->initCircle($radius, $color);
        $this->height = $height;
    }

    public function getHeight(): float
    {
        return $this->height;
    }

    public function setHeight(float $height): void
    {
        $this->height = $height;
    }

    public function getVolume(): float
    {
        return $this->getArea() * $this->height;
    }

    public function toString(): string
    {
        return "Cylinder[{$this->circleToString()},height={$this->height}]";
    }

    public function __toString(): string
    {
        return $this->toString();
    }
}