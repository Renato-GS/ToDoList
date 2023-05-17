<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function listUser()
    {
        $user = new User();
        $user-> id = 0001;
        $user-> name='Renato';
        $user-> email = 'renato@yahoo.com.br';
        $user-> password = Hash::make('senha123');

        User::create($user->all);

        echo "<h1>Listagem de usuários</h1>";
    }

    //
}
