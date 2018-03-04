<?php

use Illuminate\Database\Seeder;

class PaksSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $table = DB::table('paks');

    $paks = [
      'pak',
      'pak128',
      'pak128.Japan',
    ];

    foreach ($paks as $name) {
      $table->insert([
        'name' => $name,
      ]);
    }
  }
}
