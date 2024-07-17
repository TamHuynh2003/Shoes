<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Users;
use App\Models\Orders;
use App\Models\Genders;
use App\Models\Comments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    //

    public function index(Request $request)
    {
        $orders = Orders::where('users_id', auth('users')->user()->id)->with('status', 'order_details')->get();

        // $total =0;
        // foreach ($order as $item) {
        //     $total += $item->orders->selling_price * $item->quantity;
        // }

        $user = Users::all();
        $comment = Comments::all();
        $genders = Genders::all();
        return view('client.profile', compact('user', 'orders', 'comment', 'genders'));
    }
    public function update_profile(Request $request)
    {
        $info = Users::find(auth('users')->user()->id);
        $info->fullname = $request->fullname;
        $info->email = $request->email;
        $info->address = $request->address;
        $info->phone_number = $request->phone_number;
        $info->birth_date = $request->birth_date;;
        $info->genders_id = $request->genders_id;
        $info->save();
        return redirect()->route('profile_user')->with('alert', 'Cập nhật thông tin thành công');
    }
    public function update_password(Request $request)
    {
        $user = Users::find(auth('users')->user()->id);
        if (Hash::check($request->password_old, $user->password)) {
            $user->password = Hash::make($request->password_new);
            $user->save();
        }
        return redirect()->route('profile_user')->with('alert', 'Cập nhật mật khẩu thành công');
    }
    public function update_avatar(Request $request)
    {
        if ($request->hasFile('avatar')) {
            $user = Users::find(auth('users')->user()->id);
            $file = $request->file('avatar')->store('user_template/avatar');
            $user->avatar = $file;
            $user->save();
            return redirect()->route('profile_user')->with('alert', 'Cập nhật ảnh đại diện thành công');
        }
        dd('ko co file');
    }
    public function remove_order(Request $request)
    {
        $order = Orders::find($request->id);
        $order->status_id = 3;
        $order->save();
        return redirect()->route('profile_user')->with('alert', 'Huỷ đơn hàng thành công');
    }
}
