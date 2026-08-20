<?php
// ---------------------------------------------------------
// Task 1

// class Account
// {
//     private string $id;
//     private string $name;
//     private int $balance;

//     public function __construct(string $id, string $name, int $balance = 0)
//     {
//         $this->id = $id;
//         $this->name = $name;
//         $this->balance = $balance;
//     }

//     public function getId(): string
//     {
//         return $this->id;
//     }

//     public function getName(): string
//     {
//         return $this->name;
//     }

//     public function getBalance(): int
//     {
//         return $this->balance;
//     }

//     public function credit(int $amount): int
//     {
//         $this->balance += $amount;
//         return $this->balance;
//     }

//     public function debit(int $amount): int
//     {
//         if ($amount <= $this->balance) {
//             $this->balance -= $amount;
//         } else {
//             echo "Amount exceeded balance\n";
//         }
//         return $this->balance;
//     }

//     public function transferTo(Account $another, int $amount): int
//     {
//         if ($amount <= $this->balance) {
//             $this->balance -= $amount;
//             $another->credit($amount);
//         } else {
//             echo "Amount exceeded balance\n";
//         }
//         return $this->balance;
//     }

//     public function toString(): string
//     {
//         return "Account[id={$this->id},name={$this->name},balance={$this->balance}]";
//     }

//     public function __toString(): string
//     {
//         return $this->toString();
//     }
// }
// $A = new Account("A001", "John Doe", 1000);
// echo $A->credit(500), "<br>";


// ---------------------------------------------------------
// Task 2

// class Ball
// {
//     private float $x;
//     private float $y;
//     private int $radius;
//     private float $xDelta;
//     private float $yDelta;

//     public function __construct(float $x, float $y, int $radius, float $xDelta, float $yDelta)
//     {
//         $this->x = $x;
//         $this->y = $y;
//         $this->radius = $radius;
//         $this->xDelta = $xDelta;
//         $this->yDelta = $yDelta;
//     }

//     public function getX(): float
//     {
//         return $this->x;
//     }

//     public function setX(float $x): void
//     {
//         $this->x = $x;
//     }

//     public function getY(): float
//     {
//         return $this->y;
//     }

//     public function setY(float $y): void
//     {
//         $this->y = $y;
//     }

//     public function getRadius(): int
//     {
//         return $this->radius;
//     }

//     public function setRadius(int $radius): void
//     {
//         $this->radius = $radius;
//     }

//     public function getXDelta(): float
//     {
//         return $this->xDelta;
//     }

//     public function setXDelta(float $xDelta): void
//     {
//         $this->xDelta = $xDelta;
//     }

//     public function getYDelta(): float
//     {
//         return $this->yDelta;
//     }

//     public function setYDelta(float $yDelta): void
//     {
//         $this->yDelta = $yDelta;
//     }

//     public function move(): void
//     {
//         $this->x += $this->xDelta;
//         $this->y += $this->yDelta;
//     }

//     public function reflectHorizontal(): void
//     {
//         $this->xDelta = -$this->xDelta;
//     }

//     public function reflectVertical(): void
//     {
//         $this->yDelta = -$this->yDelta;
//     }

//     public function toString(): string
//     {
//         return "Ball[({$this->x},{$this->y}),speed=({$this->xDelta},{$this->yDelta})]";
//     }

//     public function __toString(): string
//     {
//         return $this->toString();
//     }
// }
// $b = new Ball(0, 0, 5, 1, 1);
// $b->move();


// echo $b->__toString(), "<br>";








































?>