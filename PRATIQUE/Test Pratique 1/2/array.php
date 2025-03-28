<?php

$users = [
    ['name' => 'William', 'email' => 'william@example.com'],
    ['name' => 'Bob', 'email' => 'bob@example.com']
];

foreach ($users as $user) {
    echo "Nom : " . $user['name'] . " - Email : " . $user['email'] . "<br>";
}
