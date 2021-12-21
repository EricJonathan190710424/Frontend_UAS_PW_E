<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Helper\Apibuilder as Api;
use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $data, $code;

    public function __construct()
    {
        $this->code = 200;
        $this->data = [];
    }

    public function login(UserRequest $request)
    {
        try {
            if (Auth::attempt(['email' => $request->validated()['email'], 'password' => $request->validated()['password']])) {
                if (Auth::user()->email_verified_at == NULL) {
                    return Api::apiRespond(400, ['Email is not verified. Please confirm your email!']);
                }
                $data['user'] = Auth::user();
                $data['token'] = Auth::user()->createToken('auth-api')->plainTextToken;;
                $this->data = $data;
            } else {
                return Api::apiRespond(400, ['Username Dan Password Anda Salah']);
            }
        } catch (Exception $e) {
            $this->code = 500;
            $this->data = $e->getMessage();
        }
        return Api::apiRespond($this->code, $this->data);
    }

    public function register(UserRegisterRequest $request)
    {
        try {
            $storedData = $request->validated();
            $storedData['password'] = Bcrypt($storedData['password']);
            $this->data = User::create($storedData);
            $this->code = 201;
            (new MailController)->sendEmail($this->data->id, $this->data->name, $this->data->email);
        } catch (Exception $e) {
            $this->code = 500;
            $this->data = $e->getMessage();
        }

        return Api::apiRespond($this->code, $this->data);
    }

    public function verify(User $user)
    {
        try {
            $user->email_verified_at = Carbon::now();
            $user->save();
        } catch (Exception $e) {
            $this->code = 500;
            $this->data = $e->getMessage();
        }

        return Api::apiRespond($this->code, $this->data);
    }

    public function getUser(User $user)
    {
        try {
            $this->data = $user;
        } catch (Exception $e) {
            $this->code = 500;
            $this->data = $e->getMessage();
        }

        return Api::apiRespond($this->code, $this->data);
    }

    public function updateUser(Request $request, User $user)
    {
        try {
            $this->data = $user->update($request->all());
        } catch (Exception $e) {
            $this->code = 500;
            $this->data = $e->getMessage();
        }

        return Api::apiRespond($this->code, $this->data);
    }

    public function uploadImage(Request $request, User $user)
    {
        try {

            $name = time() . '.' . $request->image->extension();

            $request->image->move(public_path('images'), $name);
            $user->photo = $name;
            $user->save();
        } catch (Exception $e) {
            $this->code = 500;
            $this->data = $e->getMessage();
        }

        return Api::apiRespond($this->code, $this->data);
    }
}
