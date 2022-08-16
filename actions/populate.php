<?php
include("../vendor/autoload.php");

use Faker\Factory as Faker;

use Libs\Database\MySQL;
use Libs\Database\UsersTable;


$faker = Faker::create();

$table = new UsersTable(new MySQL());

if ($table) {
    for ($i = 0; $i < 10; $i++) {
        $data = [
            'name' => $faker->name,
            'email' => $faker->email,
            'phone' => $faker->phoneNumber,
            'address' => $faker->address,
            'password' => password_hash(('password'), PASSWORD_BCRYPT),
            'role_id' => $i < 5 ? rand(1, 3) : 1,
        ];
        $table->insert($data);
    }
}