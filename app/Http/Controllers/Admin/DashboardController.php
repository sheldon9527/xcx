<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;

class DashboardController extends BaseController
{
    /**
     * [dashboard 仪表盘]
     * @return [type] [description]
     */
    public function dashboard()
    {
        return view('admin.dashboard.dashboard', compact(''));
    }
}
