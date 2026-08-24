<?php

use Illuminate\Support\Facades\Route;

$students = [
    1 => ['id' => 1, 'name' => 'Youssef Hegazy', 'age' => 22, 'track' => 'Gen AI'],
    2 => ['id' => 2, 'name' => 'Nooh Zidan', 'age' => 21, 'track' => 'pen tester'],
    3 => ['id' => 3, 'name' => 'Mohamed Sadeq', 'age' => 21, 'track' => 'Cyber Security'],
];

Route::get('/students', function () use ($students) {
    return view('allStudents', ['students' => $students]);
});

Route::get('/students/{id}', function ($id) use ($students) {
    if (!array_key_exists($id, $students)) {
        abort(404, 'Student not found');
    }
    return view('student', ['student' => $students[$id]]);
});