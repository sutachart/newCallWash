<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ApiController extends Controller
{
    // function test(){
    // 	$firebase = new \Geckob\Firebase\Firebase('../apiFirebase.json');
    // 	$temp = [];
    // 	$temp = $firebase->get('/getData');

    //         return response()->json(['status' => '1',
    //             'message' => 'Gotcha!!!',
    //             'data' => $temp], 200);
    // }

    public function insertUser(Request $request){
        $user_id;
        $user_address = $request['order_address'];
        $user_price = $request['order_price'];
        $user_service = $request['order_service'];
        $user_latitude = $request['order_latitude'];
        $user_longtitude = $request['order_longtitude'];
        $tid = $request['order_tid'];

        $result = DB::table('user')->insert([
            'user_address' => $user_address,
            'user_price' => $user_price,
            'user_service' => $user_service,
            'user_latitude' => $user_latitude,
            'user_longtitude' => $user_longtitude,
            'tid' => $tid
        ]);
        return response()->json('success');
    }

    public function updateTransaction(Request $request){
        $status = $request['status'];

        $result = DB::table('transaction')->insert([
            'status' => $status
        ]);
        $tran = DB::table('transaction')
            ->select('tran_id')
            ->orderBy('tran_id', 'desc')
            ->get();
        
        return response()->json(['transaction'=>$tran]);
    }

    public function checkStatus(){
        $user_id = 12;
        $result = DB::table('transaction')
            ->select('transaction.status')
            ->join('user','user.tid','=','transaction.tran_id')
            ->where('user.user_id','=',$user_id)
            ->get();
    return response()->json(['status' => $result]);
    }

    public function getCallwash(){
        $result = DB::table('transaction')
            ->select('transaction.status','user.user_id','user.user_address')
            ->join('user','user.tid','=','transaction.tran_id')
            ->where('status','=','0')
            ->get();
    return response()->json(['status' => $result]);
    }
}