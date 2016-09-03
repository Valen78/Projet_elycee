<?php

use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        $json = File::get("database/data/users.json");

        $datas = json_decode($json);

        $password = Hash::make('dev2016');

        foreach($datas as $objet)
        {
            $this->insert($objet->teacher, $password, 'teacher');
            $this->insert($objet->first_class, $password, 'first_class');
            $this->insert($objet->final_class, $password, 'final_class');
        }
    }

    /**
     * @param $obj
     * @param $password
     * @param $role
     */
    public function insert($obj, $password, $role)
    {
        for($i=0;$i<=count($obj)-1;$i++)
        {
            User::create(array(
                'username'=> $obj[$i]->username,
                'password'=> $password,
                'role'=>$role
            ));
        }
    }
}
