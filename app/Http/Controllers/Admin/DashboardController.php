<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use App\Http\Requests;

class DashboardController extends AdminController
{

	/**
	 * DashboardController constructor.
	 */
	public function __construct()
	{
		parent::__construct();
	}

	public function getIndex()
	{
		return view('admin.dashboard.index');
    }
}
