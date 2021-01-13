<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\ApiController;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
class UserController extends ApiController
{

    public function index()
    {
        $users = User::all();
        return $this->showAll($users);
    }

    public function store(UserRequest $request)
    {
        $data = $request->except('password' ,'verified','verification_token' , 'admin');
        $data['password']= bcrypt($request->password);
        $data['verified']= User::UNVERIFIED_USER;
        $data['verification_token']  =User::generateVerificationCode();
        $data['admin']= User::REGULAR_USER;
        $user = User::create($data);
        return $this->successResponse($user , 201);

    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return $this->showOne($user);


    }

    public function update(Request $request, User $user)
    {
//        $rules = [
//            'email' => 'email|unique:users,email,' . $user->id,
//            'password' => 'min:6|confirmed',
//            'admin' => 'in:' . User::ADMIN_USER . ',' . User::REGULAR_USER,
//        ];

        if ($request->has('name')) {
            $user->name = $request->name;
        }

        if ($request->has('email') && $user->email !== $request->email) {
            $user->verified = User::UNVERIFIED_USER;
            $user->verification_token = User::generateVerificationCode();
            $user->email = $request->email;
            $user->admin = 0 ;
        }
        elseif ($request->has('email') && $user->email === $request->email)
        {
            $user->verified = User::VERIFIED_USER;
            $user->email = $request->email;
            $user->verification_token = null;

        }
        if ($request->has('password')) {
            $user->password = bcrypt($request->password);
        }

        if ($request->has('admin')) {

            if (!$user->isVerified() ) {
                return $this->errorResponse('Only verified users can modify the admin field', 409);
            }
            $user->admin = $request->admin;
        }

        if (!$user->isDirty()) {
            return $this->errorResponse('You need to specify a different value to update', 422);
        }

        $user->save();
        return $this->successResponse($user , 200);

    }

    public function destroy($id)
    {
         $user=User::find($id);
        if (is_null($user))
        {
            return $this->errorResponse('found record', 404);

        }
        $user->delete();
        return $this->successResponse(['message' => "deleted"] , 202);
    }
}
