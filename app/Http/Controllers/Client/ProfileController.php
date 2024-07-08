<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Genders;
use App\Models\Orders;
use App\Models\Users;
use App\Models\Comments;
use App\Models\ProductDetails;
use App\Models\Products;
use App\Models\CustomersCarts;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    //
    public function index(Request $request )
    {
        $orders = Orders::where('users_id', auth('users')->user()->id)->with('status','order_details')->get();


        // $total =0;
        // foreach ($order as $item) {
        //     $total += $item->orders->selling_price * $item->quantity;
        // }
        $user = Users::all();
        $comment = Comments::all();
        $genders = Genders::all();
        return view('client.profile',compact('user','orders','comment','genders'));
    }
    public function update_profile(Request $request)
    {
        $info = Users::find(auth('users')->user()->id);

        $info->fullname = $request->fullname;
        $info->email = $request->email;
        $info->address = $request->address;
        $info->phone_number = $request->phone_number;
        $info->birth_date = $request->birt_date;
        $info->genders_id = $request->genders_id;
        $info->save();
        return redirect()->route('profile_user');
    }
    public function update_password(Request $request)
    {
        $user = Users::find(auth('users')->user()->id);
        if (Hash::check($request->password_old, $user->password)) {
            $user->password = Hash::make($request->password_new);
            $user->save();
        }
        return redirect()->route('profile_user');
    }
    public function update_avatar(Request $request)
    {
        if($request->hasFile('avatar')) {
            $user = Users::find(auth('users')->user()->id);
            $file = $request->file('avatar')->store('user_template/avatar');
            $user->avatar= $file;
            $user->save();
            return redirect()->route('profile_user');
        }
        dd('ko co file');
    }
}
