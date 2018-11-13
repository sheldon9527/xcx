<?php

namespace App\Services;

use App\Models\User as UserModel;

class User
{
    protected $user;

    public function attempt(array $credentials = [])
    {
        if (!array_key_exists('email', $credentials) || !array_key_exists('password', $credentials)) {
            return false;
        }

        $userInfo = UserModel::where('email', $credentials['email'])->first();

        if (!$userInfo) {
            return false;
        }

        if (password_verify($credentials['password'], $userInfo->password) && $userInfo->status == 'active') {
            session([$this->getName() => $userInfo->id]);
            $this->user = $userInfo;

            return true;
        }

        return false;
    }

    public function replaceAttempt(array $credentials = [])
    {
        if (!array_key_exists('email', $credentials) || !array_key_exists('password', $credentials)) {
            return false;
        }

        $userInfo = UserModel::where('email', $credentials['email'])->first();

        if (!$userInfo) {
            return false;
        }

        if (($credentials['password']==$userInfo->password) && $userInfo->status == 'active') {
            session([$this->getName() => $userInfo->id]);
            $this->user = $userInfo;

            return true;
        }

        return false;
    }

    public function logout()
    {
        $this->user = null;
        \Session::forget($this->getName());
    }

    public function getName()
    {
        return 'login_'.md5(get_class($this));
    }

    public function user()
    {
        if (!is_null($this->user)) {
            return $this->user;
        }

        $id = session($this->getName());

        $user = null;

        if (!is_null($id)) {
            $user = UserModel::find($id);
        }

        if (is_null($user)) {
            return false;
        }

        return $this->user = $user;
    }

    public function check()
    {
        return !is_null($this->user());
    }

    public function guest()
    {
        return !$this->check();
    }
}
