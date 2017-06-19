<?php

namespace App\Http\Controllers;

use App\Sanpham;
use App\Sanphams;
use Illuminate\Http\Request;
use Response;
use App\Http\Requests;

class listingproduct extends Controller
{
    public function showdetail($id){
        $data= Sanphams::where('danhmucs_id',$id)->paginate(8);
        return Response::json($data);
    }

    public function getSanpham(Request $request,$id)
    {
        if (!$request->ajax()) {
            return response()->json([
                'status' => false,
                'message' => 'error ',
            ]);
        }

        // $combos = $this->repository->paginate(config('settings.paginate_limit'), ['title', 'id']);
         $datas= Sanphams::where('danhmucs_id',$id)->paginate(8);
        $view = view('admin.component.sanpham', compact('datas'))->render();

        return response()->json([
            'status' => true,
            'view' => $view,
        ]);
    }
}
