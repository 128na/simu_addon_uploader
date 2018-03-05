<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $table = DB::table('users');

    $table->insert([
        'name' => env('ADMIN_NAME'),
        'email' => env('ADMIN_EMAIL'),
        'password' => Hash::make(env('ADMIN_PASS')),
        'is_admin' => 1,
    ]);
  }
}
