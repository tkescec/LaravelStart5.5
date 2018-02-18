<?php

namespace App\Http\Controllers\Admin;

use Sentinel;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Users;
use Carbon\Carbon;

class DashboardController extends Controller
{
  /**
   * Set middleware to quard controller.
   *
   * @return void
   */
    public function __construct()
    {
        $this->middleware('sentinel.auth');
        //$this->middleware('sentinel.role:administrator');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $date = new Carbon;
        $date->subDays(7);

        $users_count = Users::where('created_at', '>', $date->toDateTimeString() )->count();

        return view('admin.dashboard', [
            'users_count' => $users_count
        ]);
    }
}
