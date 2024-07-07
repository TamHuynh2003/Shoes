@extends('client.master')

@section('content')
<div class="container">
    <div class="container" style="margin-top: 150px;margin-bottom: 150px;display: flex">

        <div class="col-md-3">
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action active"
                    onclick="showSection('user-profile')">Trang Cá Nhân</a>
                <a href="#" class="list-group-item list-group-item-action" onclick="showSection('user-cart')">Đơn
                    Hàng</a>
                <a href="#" class="list-group-item list-group-item-action" onclick="showSection('user-rating')">Đánh
                    Giá</a>
            </div>
        </div>

        <div class="col-md-10">
            <div class="card" id="user-profile">
                <div class="card-body">
                    <h4 class="card-title">Chỉnh Sửa Trang Cá Nhân</h4>
                    <form class="form-horizontal" method="POST" action="">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Fullname</label>
                            <div class="col-sm-10">
                                {{-- <input type="text" name="fullname" value="{{ old('fullname', $user->fullname) }}"
                                    class="form-control"> --}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                {{-- <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                    class="form-control"> --}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Address</label>
                            <div class="col-sm-10">
                                {{-- <textarea class="form-control"
                                    name="address">{{ old('address', $user->address) }}</textarea> --}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                                {{-- <input type="password" name="password" class="form-control"> --}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Phone Number</label>
                            <div class="col-sm-10">
                                {{-- <input type="text" name="phone_number"
                                    value="{{ old('phone_number', $user->phone_number) }}" class="form-control"> --}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Birth Date</label>
                            <div class="col-sm-10">
                                {{-- <input type="date" name="birth_date"
                                    value="{{ old('birth_date', $user->birth_date) }}" class="form-control"> --}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Gender</label>
                            <div class="col-sm-10">
                                {{-- <select class="form-control" name="genders_id">
                                    @foreach($genders as $gender)
                                    <option value="{{ $gender->id }}" {{ $gender->id == old('genders_id',
                                        $user->genders_id) ? 'selected' : '' }}>{{ $gender->name }}</option>
                                    @endforeach
                                </select> --}}
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
                <div class="card-body">
                    <h4 class="card-title">Đơn Hàng</h4>
                    <p>Thông tin đơn hàng sẽ được hiển thị ở đây.</p>
                </div>
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