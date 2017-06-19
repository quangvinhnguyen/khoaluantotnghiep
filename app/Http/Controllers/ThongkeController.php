<?php

namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Redirect;
use Schema;
use App\Http\Requests;
use App\Donhangs;
use App\Chitietdonhangs;
class ThongkeController extends Controller
{
    public function thongKeTheodate(Request $request ,$date)
    {

        if (!$request->ajax()) {
            return response()->json([
                'status' => false,
                'message' => 'error ',
            ]);
        }
        $donhangs= Donhangs::where('ngay_lap',$date)->with('chitietdonhangs')->paginate(8);
        $view = view('admin.component.thongke', compact('donhangs'))->render();


        return response()->json([
            'status' => true,
            'view' => $view,
        ]);
    }
}
