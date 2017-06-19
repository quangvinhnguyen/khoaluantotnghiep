<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Donhangs;
// use App\Chitietdonhangs;
use App\Http\Requests\CreateDonhangsRequest;
use App\Http\Requests\UpdateDonhangsRequest;
use App\Http\Requests\CreateChitietdonhangsRequest;
use App\Http\Requests\UpdateChitietdonhangsRequest;
use Illuminate\Http\Request;

use App\Khachhangs;
use App\Sanphams;
use App\Danhmucs;


class DonhangsController extends Controller {

	/**
	 * Display a listing of donhangs
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $donhangs = Donhangs::with("khachhangs")->get();

		return view('admin.donhangs.index', compact('donhangs'));
	}

	/**
	 * Show the form for creating a new donhangs
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    $khachhangs = Khachhangs::pluck("ten_kh", "id")->prepend('Please select', null);
		$danhmucs = Danhmucs::pluck("ten_dm", "id")->prepend('Please select', null);

	    return view('admin.donhangs.create', compact("khachhangs","danhmucs"));
	}

	/**
	 * Store a newly created donhangs in storage.
	 *
     * @param CreateDonhangsRequest|Request $request
	 */
	public function store(CreateDonhangsRequest $request)
	{
		$data = $request->only(
            'ngay_lap',
            'khachhangs_id',
			'sanphams'
        );

		$dh = Donhangs::create($data);
		$oop = [];

		foreach($data['sanphams'] as $item)
		{
			$oop[] = [
				'don_gia' => $item['don_gia'],
				'sanphams_id' => $item['sanphams_id'],
				'so_luong' => $item['so_luong'],
			];

		}

		$ct  = $dh->chitietdonhangs()->createMany($oop);

		return redirect()->route(config('quickadmin.route').'.donhangs.index');
	}

	/**
	 * Show the form for editing the specified donhangs.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$donhangs = Donhangs::find($id);
	    $khachhangs = Khachhangs::pluck("ten_kh", "id")->prepend('Please select', null);
		$danhmucs = Danhmucs::pluck("ten_dm", "id")->prepend('Please select', null);

		return view('admin.donhangs.edit', compact('donhangs', "khachhangs","danhmucs"));
	}

	/**
	 * Update the specified donhangs in storage.
     * @param UpdateDonhangsRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateDonhangsRequest $request)
	{
		$data = $request->only(
            'ngay_lap',
            'khachhangs_id',
			'sanphams',
			'sanphamUpdate',
			'productDeleteIds'
        );

		$dh = Donhangs::findOrFail($id);
		$dh->update($data);

		if(!empty($data['sanphamUpdate']))
		{
			foreach ($data['sanphamUpdate'] as $ct )
			{
				$cts =$dh->chitietdonhangs()->where('id', $ct["id"])->first();
				$cts->update($ct);
			}
		}


		if (!empty($data['productDeleteIds'])) {
            $ids = explode(',', $data['productDeleteIds']);
			$ctid = $dh->chitietdonhangs()->whereIn('sanphams_id' , $ids)->delete();
        }

        if (!empty($data['sanphams'])) {
           $dh->chitietdonhangs()->createMany($data['sanphams']);
        }

		return redirect()->route(config('quickadmin.route').'.donhangs.index');
	}

	/**
	 * Remove the specified donhangs from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Donhangs::destroy($id);

		return redirect()->route(config('quickadmin.route').'.donhangs.index');
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
            Donhangs::destroy($toDelete);
        } else {
            Donhangs::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.donhangs.index');
    }
}
