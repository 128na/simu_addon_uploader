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
    if (env('ADMIN_NAME')) {
      DB::table('users')->insert([
        'name' => env('ADMIN_NAME'),
        'email' => env('ADMIN_EMAIL'),
        'password' => Hash::make(env('ADMIN_PASS')),
        'is_admin' => 1,
      ]);
    } else {
      throw new \Error('.envファイルから管理者情報が取得できませんでした');
    }

  }
}
