<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Sanphams;
use App\Http\Requests\CreateSanphamsRequest;
use App\Http\Requests\UpdateSanphamsRequest;
use Illuminate\Http\Request;
use App\Danhmucs;

class SanphamsController extends Controller
{
	/**
	 * Display a listing of sanphams
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $sanphams = Sanphams::with("danhmucs")->get();

		return view('admin.sanphams.index', compact('sanphams'));
	}

	/**
	 * Show the form for creating a new sanphams
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    $danhmucs = Danhmucs::pluck("ten_dm", "id")->prepend('Please select', null);


	    return view('admin.sanphams.create', compact("danhmucs"));
	}

	/**
	 * Store a newly created sanphams in storage.
	 *
     * @param CreateSanphamsRequest|Request $request
	 */
	public function store(CreateSanphamsRequest $request)
	{
		$data = $request->all();
	    // $request = $this->saveFiles($request);
		$data['hinh_anh'] = $this->uploadImg($request->hinh_anh);
		$imgs = [];
		// dd($data['hinh_anh']);
        foreach ($data['hinh_anh'] as $img) {
            $imgs[] = [
                'ten_ha' => $img,
            ];
        }

		$inputs = array_except($data, ['_token', 'hinh_anh']);
		$inputs['hinh_anh'] = $imgs[0]['ten_ha'];
		$sp = Sanphams::create($inputs);
       	$sp->hinhanhs()->createMany($imgs);

		return redirect()->route(config('quickadmin.route').'.sanphams.index');
	}

	/**
	 * Show the form for editing the specified sanphams.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$sanphams = Sanphams::find($id);
	    $danhmucs = Danhmucs::pluck("ten_dm", "id")->prepend('Please select', null);

		return view('admin.sanphams.edit', compact('sanphams', "danhmucs"));
	}

	/**
	 * Update the specified sanphams in storage.
     * @param UpdateSanphamsRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateSanphamsRequest $request)
	{
		$sanphams = Sanphams::findOrFail($id);

        // $request = $this->saveFiles($request);
				$data = $request->all();
	    // $request = $this->saveFiles($request);
		$data['hinh_anh'] = $this->uploadImg($request->hinh_anh);
		$imgs = [];
		// dd($data['hinh_anh']);
        foreach ($data['hinh_anh'] as $img) {
            $imgs[] = [
                'ten_ha' => $img,
            ];
        }

		$inputs = array_except($data, ['_token', 'hinh_anh']);
		$inputs['hinh_anh'] = $imgs[0]['ten_ha'];
		$sanphams->update($inputs);
       	$sanphams->hinhanhs()->createMany($imgs);
		// $sanphams->update($request->all());

		return redirect()->route(config('quickadmin.route').'.sanphams.index');
	}

	/**
	 * Remove the specified sanphams from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Sanphams::destroy($id);

		return redirect()->route(config('quickadmin.route').'.sanphams.index');
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
            Sanphams::destroy($toDelete);
        } else {
            Sanphams::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.sanphams.index');
    }

}
