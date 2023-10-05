<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    protected $permissions=[
        'all_categories'=>'Show All Categories',
        'crate_category'=>'Crate Category',
        'edit_category'=>'Edit Category',
        'delete_category'=>'Delete Category',


        'all_skills'=>'Show All Skills',
        'crate_skill'=>'Crate skill',
        'edit_skill'=>'Edit skill',
        'delete_skill'=>'Delete skill',
    ];

    public function run(): void
    {
        Permission::truncate();
        foreach($this->permissions as $code=>$name){
            Permission::create([
                'name'=>$name,
                'code'=>$code,
            ]);

        }
    }
}
