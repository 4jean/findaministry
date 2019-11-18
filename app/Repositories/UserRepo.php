<?php

namespace App\Repositories;

use App\User;

class UserRepo {


    public function update($id, $data)
    {
        return User::find($id)->update($data);
    }

    public function all()
    {
        return User::all();
    }

    public function destroy($id)
    {
        return User::destroy($id);
    }
}
