<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    protected $user;

    protected $request;
    /**
     * [__construct 构造函数]
     * @param Request $request [description]
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    /**
     * [user 用户]
     * @return [type] [description]
     */
    public function user()
    {
        if (!$this->user) {
            $this->user = app('user')->user();
        }

        return $this->user;
    }
}
