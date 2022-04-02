<?php

namespace Database\Seeders;

use App\Unit;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        (new Unit(["name"=>"l"]))->save();
        (new Unit(["name"=>"ml"]))->save();
        (new Unit(["name"=>"g"]))->save();
        (new Unit(["name"=>"kg"]))->save();
        (new Unit(["name"=>"Stk."]))->save();
        (new Unit(["name"=>"Pr."]))->save();
        (new Unit(["name"=>"TL"]))->save();
        (new Unit(["name"=>"EL"]))->save();
        (new Unit(["name"=>"Pck."]))->save();
    }
}
