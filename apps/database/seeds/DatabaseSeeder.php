<?php
 
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
 
class DatabaseSeeder extends Seeder {
 
/**
* Run the database seeds.
*
* @return void
*/
public function run()
{
Model::unguard();
 
$this->call('UserTableSeeder');
$this->command->info('User Table Seeded!');
}
 
}
 
class UserTableSeeder extends Seeder {
public function run()
{
DB::table('users')->delete();
DB::table('users')->insert([
'username' => 'gggg',
'email' => 'gg@gmail.com',
'password' => Hash::make('gggg'),
'name' => 'gggg',
'tel' => '080-1234567',
'type' => 'patient',
'created_at' => date('Y-m-d H:i:s')
]);
}
}
