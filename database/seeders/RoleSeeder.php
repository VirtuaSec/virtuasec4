<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name'=>'Administrador']);
        Role::create(['name'=>'Secretaria']);
        Role::create(['name'=>'Professor']);
        Role::create(['name'=>'Instituição']);
        Role::create(['name'=>'Aluno']);
    }
}
