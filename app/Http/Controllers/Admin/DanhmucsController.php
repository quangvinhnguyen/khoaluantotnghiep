<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Danhmucs;
use App\Http\Requests\CreateDanhmucsRequest;
use App\Http\Requests\UpdateDanhmucsRequest;
use Illuminate\Http\Request;



class DanhmucsController extends Controller {

	/**
	 * Display a listing of danhmucs
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $danhmucs = Danhmucs::all();

		return view('admin.danhmucs.index', compact('danhmucs'));
	}

	/**
	 * Show the form for creating a new danhmucs
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    $danhmucs = Danhmucs::pluck("ten_dm", "id")->prepend('Please select', null);
	    return view('admin.danhmucs.create',compact("danhmucs"));
	}

	/**
	 * Store a newly created danhmucs in storage.
	 *
     * @param CreateDanhmucsRequest|Request $request
	 */
	public function store(CreateDanhmucsRequest $request)
	{
	    
		Danhmucs::create($request->all());

		return redirect()->route(config('quickadmin.route').'.danhmucs.index');
	}

	/**
	 * Show the form for editing the specified danhmucs.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$danhmucs = Danhmucs::find($id);
	    $lstdanhmucs = Danhmucs::pluck("ten_dm", "id")->prepend('Please select', null);
	    
		return view('admin.danhmucs.edit', compact('danhmucs','lstdanhmucs'));
	}

	/**
	 * Update the specified danhmucs in storage.
     * @param UpdateDanhmucsRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateDanhmucsRequest $request)
	{
		$danhmucs = Danhmucs::findOrFail($id);

        

		$danhmucs->update($request->all());

		return redirect()->route(config('quickadmin.route').'.danhmucs.index');
	}

	/**
	 * Remove the specified danhmucs from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Danhmucs::destroy($id);

		return redirect()->route(config('quickadmin.route').'.danhmucs.index');
	}

    /**
     * Mass delete function from index page
     * @param Request $request
     *
     * @return mixed
     */
    public function massDelete(Request $request)
    {
        if ($request->get('toDelete') != 'mass') {
            $toDelete = json_decode($request->get('toDelete'));
            Danhmucs::destroy($toDelete);
        } else {
            Danhmucs::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.danhmucs.index');
    }

}
