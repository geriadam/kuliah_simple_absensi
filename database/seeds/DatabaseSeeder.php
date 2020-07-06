<?php

use App\Employee;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            "email" => "admin@admin.com"
        ]);
        
        $emails = [];
        for($i = 1; $i <= 20; $i++){
            $emails[] = "employee" . $i . "@gamil.com";
        }

        foreach($emails as $i => $email){
            $user = factory(User::class)->create([
                "email" => $email
            ]);

            $enployee = factory(Employee::class)->create([
                "user_id" => $user->id
            ]);
        }
    }
}
