<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [

            //create classes
            [
                'name' => 'classes.store',
                'guard_name' => 'web',
            ],
            [
                'name' => 'classes.create',
                'guard_name' => 'web',
            ],
            [
                'name' => 'classes.edit',
                'guard_name' => 'web',
            ],
            [
                'name' => 'classes.update',
                'guard_name' => 'web',
            ],
            [
                'name' => 'classes.delete',
                'guard_name' => 'web',
            ],
            [
                'name' => 'classes.view',
                'guard_name' => 'web',
            ],
            [
                'name' => 'classes.viewAll',
                'guard_name' => 'web',
            ],

            //create sections

            [
                'name' => 'sections.create',
                'guard_name' => 'web',
            ],
            [
                'name' => 'sections.store',
                'guard_name' => 'web',
            ],
            [
                'name' => 'sections.edit',
                'guard_name' => 'web',
            ],
            [
                'name' => 'sections.delete',
                'guard_name' => 'web',
            ],
            [
                'name' => 'sections.view',
                'guard_name' => 'web',
            ],
            [
                'name' => 'sections.viewAll',
                'guard_name' => 'web',
            ],


            [
                'name' => 'students.create',
                'guard_name' => 'web',
            ],
            [
                'name' => 'students.store',
                'guard_name' => 'web',
            ],
            [
                'name' => 'students.edit',
                'guard_name' => 'web',
            ],
            [
                'name' => 'students.update',
                'guard_name' => 'web',
            ],
            [
                'name' => 'students.delete',
                'guard_name' => 'web',
            ],
            [
                'name' => 'students.view',
                'guard_name' => 'web',
            ],
            [
                'name' => 'students.viewAll.',
                'guard_name' => 'web',
            ],

            [
                'name' => 'teachers.create',
                'guard_name' => 'web',
            ],
            [
                'name' => 'teachers.store',
                'guard_name' => 'web',
            ],
            [
                'name' => 'teachers.edit',
                'guard_name' => 'web',
            ],
            [
                'name' => 'teachers.update',
                'guard_name' => 'web',
            ],
            [
                'name' => 'teachers.delete',
                'guard_name' => 'web',
            ],
            [
                'name' => 'teachers.view',
                'guard_name' => 'web',
            ],
            [
                'name' => 'teachers.viewAll.',
                'guard_name' => 'web',
            ],




            //create images

            [
                'name' => 'images.create',
                'guard_name' => 'web',
            ],
            [
                'name' => 'images.store',
                'guard_name' => 'web',
            ],
            [
                'name' => 'images.edit',
                'guard_name' => 'web',
            ],
            [
                'name' => 'images.update',
                'guard_name' => 'web',
            ],
            [
                'name' => 'images.delete',
                'guard_name' => 'web',
            ],
            [
                'name' => 'images.view',
                'guard_name' => 'web',
            ],
            [
                'name' => 'images.viewAll',
                'guard_name' => 'web',
            ],


            [
                'name' => 'roles.view',
                'guard_name' => 'web',
            ],
            [
                'name' => 'roles.create',
                'guard_name' => 'web',
            ],
            [
                'name' => 'roles.delete',
                'guard_name' => 'web',
            ],
            [
                'name' => 'roles.edit',
                'guard_name' => 'web',
            ],




        ];

        Permission::insert($permissions);

    }
}
