<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            ['id' => 1, 'name' => 'call'],
            ['id' => 2, 'name' => 'visit'],
            ['id' => 3, 'name' => 'follow up'],
        ];
        foreach ($statuses as $status) {
            Status::create($status);
        }

    }
}
