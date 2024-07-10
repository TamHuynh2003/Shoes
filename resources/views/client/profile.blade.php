@extends('client.master')

@section('content')
    <div class="container">
        <div class="container" style="margin-top: 150px;margin-bottom: 150px;display: flex">

            <div class="col-md-3">
                <div class="list-group">
                    <a href="# " class="list-group-item list-group-item-action active"
                        onclick="showSection('user-profile')">Trang Cá Nhân</a>
                    <a href="#" class="list-group-item list-group-item-action" onclick="showSection('user-cart')">Đơn
                        Hàng</a>
                    <a href="#" class="list-group-item list-group-item-action"
                        onclick="showSection('user-rating')">Đánh
                        Giá</a>
                </div>
            </div>

            <div class="col-md-10">
                <div class="card" id="user-profile">
                    <div class="card-body">

                        <h4 class=" mt-5 card-title">Đổi Ảnh Đại Diện</h4>

                        <form class="form-horizontal" method="POST" action="{{ route('update_avatar_profile_user') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="d-flex" style="justify-content: center; flex-direction: column; align-items:center">
                                <img id="displayImage"
                                    src="{{ auth('users')->user()->avatar ? auth('users')->user()->avatar : null }}"
                                    alt="Your Image" style="display: block; width: 300px; height: auto; margin-top: 20px;">
                                <input type="file" id="fileInput" accept="image/*" class="my-3" name="avatar">
                            </div>
                            <script>
                                document.getElementById('fileInput').addEventListener('change', function(event) {
                                    const file = event.target.files[0];
                                    if (file) {
                                        const reader = new FileReader();
                                        reader.onload = function(e) {
                                            const img = document.getElementById('displayImage');
                                            img.src = e.target.result;
                                            img.style.display = 'block';
                                        };
                                        reader.readAsDataURL(file);
                                    }
                                });
                            </script>

                            <div class="form-group row my-5">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Cập Nhật</button>
                                </div>
                            </div>

                        </form>

                        <h4 class="card-title">Chỉnh Sửa Trang Cá Nhân</h4>

                        <form class="form-horizontal" method="POST" action="{{ route('update_profile_user') }}">
                            @csrf
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Fullname</label>
                                <div class="col-sm-10">
                                    <input type="text" name="fullname" value="{{ auth('users')->user()->fullname }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" name="email" value="{{ auth('users')->user()->email }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Address</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="address">{{ auth('users')->user()->address }}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Phone Number</label>
                                <div class="col-sm-10">
                                    <input type="text" name="phone_number"
                                        value="{{ auth('users')->user()->phone_number }}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Birth Date</label>
                                <div class="col-sm-10">
                                    <input type="date" name="birth_date" value="{{ auth('users')->user()->birt_date }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Gender</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="genders_id">
                                        @foreach ($genders as $item)
                                            <option value="{{ $item->id }}"
                                                {{ $item->id = auth('users')->user()->genders_id ? 'selected' : '' }}>
                                                {{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Cập Nhật</button>
                                </div>
                            </div>
                        </form>


                        <h4 class=" mt-5 card-title">Đổi mật khẩu</h4>
                        <form class="form-horizontal" method="POST" action="{{ route('update_password_profile_user') }}">
                            @csrf

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Nhập mật khẩu cũ</label>
                                <div class="col-sm-10">
                                    <input type="password" name="password_old" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Nhập mật khẩu mới</label>
                                <div class="col-sm-10">
                                    <input type="password" name="password_new" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Cập Nhật</button>
                                </div>
                            </div>

                        </form>


                    </div>


                </div>




                <div class="card d-none" id="user-cart">
                    @foreach ($orders as $order)
                        <div class="card-body">
                            <h4 class="card-title">Đơn Hàng {{ $order->id }}</h4>

                            <div class="d-flex" style="justify-content: space-between">

                                <strong>
                                    Ngày Mua: {{ $order->order_date }}
                                </strong>
                                <strong>
                                    Trạng Thái: {{ $order->status->name }}
                                </strong>
                            </div>
                            <table class="table-shopping-cart">
                                <tr class="table_head">
                                    <th class="column-1">Ảnh</th>
                                    <th class="column-2">Giày</th>
                                    <th class="column-3">Số Lượng</th>
                                    <th class="column-4">Giá</th>

                                </tr>
                                @foreach ($order->order_details as $item)
                                    <tr class="table_row">
                                        <td class="column-1">
                                            <div class="how-itemcart1">
                                                <img src="{{ asset('user_template/images/item-cart-04.jpg') }}"
                                                    alt="IMG">
                                            </div>
                                        </td>
                                        <td class="column-2"> {{ $item->product->name }}</td>
                                        <td class="column-3"> {{ $item->quantity }}</td>
                                        <td class="column-4"> {{ $item->selling_price }} VND</td>

                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    @endforeach
                </div>




                <div class="card d-none" id="user-rating">
                    <div class="card-body">
                        <h4 class="card-title">Đánh Giá</h4>
                        <p>Thông tin đánh giá sẽ được hiển thị ở đây.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script>
        function showSection(sectionId) {

            document.getElementById('user-profile').classList.add('d-none');
            document.getElementById('user-cart').classList.add('d-none');
            document.getElementById('user-rating').classList.add('d-none');


            var links = document.querySelectorAll('.list-group-item');
            links.forEach(link => link.classList.remove('active'));


            document.getElementById(sectionId).classList.remove('d-none');


            event.target.classList.add('active');
        }
    </script>
@endsection
