<?php

class DB {
    private $pdo;

    public function __construct() {
        $host = 'localhost';
        $db = 'iti_sm_php_g2_2026';
        $user = 'root';
        $pass = '';

        $this->pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    }

    public function index($table) {
        $stmt = $this->pdo->prepare("SELECT * FROM $table");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function show($table, $id) {
        $stmt = $this->pdo->prepare("SELECT * FROM $table WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($table, $data) {
        if ($table === 'users') {
            $stmt = $this->pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
            return $stmt->execute([$data['name'], $data['email'], $data['password']]);
        }

        if ($table === 'employees') {
            $stmt = $this->pdo->prepare("INSERT INTO employees (name, position, salary) VALUES (?, ?, ?)");
            return $stmt->execute([$data['name'], $data['position'], $data['salary']]);
        }

        if ($table === 'departments') {
            $stmt = $this->pdo->prepare("INSERT INTO departments (name) VALUES (?)");
            return $stmt->execute([$data['name']]);
        }

        if ($table === 'projects') {
            $stmt = $this->pdo->prepare("INSERT INTO projects (title, budget) VALUES (?, ?)");
            return $stmt->execute([$data['title'], $data['budget']]);
        }
    }

    public function update($table, $id, $data) {
        if ($table === 'users') {
            $stmt = $this->pdo->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
            return $stmt->execute([$data['name'], $data['email'], $id]);
        }

        if ($table === 'employees') {
            $stmt = $this->pdo->prepare("UPDATE employees SET name = ?, position = ?, salary = ? WHERE id = ?");
            return $stmt->execute([$data['name'], $data['position'], $data['salary'], $id]);
        }

        if ($table === 'departments') {
            $stmt = $this->pdo->prepare("UPDATE departments SET name = ? WHERE id = ?");
            return $stmt->execute([$data['name'], $id]);
        }

        if ($table === 'projects') {
            $stmt = $this->pdo->prepare("UPDATE projects SET title = ?, budget = ? WHERE id = ?");
            return $stmt->execute([$data['title'], $data['budget'], $id]);
        }
    }

    public function delete($table, $id) {
        $stmt = $this->pdo->prepare("DELETE FROM $table WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function findByColumn($table, $column, $value) {
        $stmt = $this->pdo->prepare("SELECT * FROM $table WHERE $column = ?");
        $stmt->execute([$value]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

$db = new DB();