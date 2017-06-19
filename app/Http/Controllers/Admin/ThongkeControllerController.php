<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Sanphams;
use App\Danhmucs;
class ThongkeControllerController extends Controller {

	/**
	 * Index page
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index()
    {
		 $sanphamhethang = Sanphams::where('so_luong',0)->with("danhmucs")->get();

		return view('admin.thongkecontroller.index', compact("sanphamhethang"));
	}



}
