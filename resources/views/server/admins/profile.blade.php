@extends('server.master')

@section('content')
<div class="page">
    <div class="page-main">
        <div class="side-app">
            <div class="main-container container-fluid">

                <div class="page-header">
                    <div class="ms-auto pageheader-btn">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Quản Trị Viên</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Trang Cá Nhân</li>
                        </ol>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-lg-12 col-md-12 col-xl-6">
                                        <div class="d-flex flex-wrap align-items-center">

                                            <div class="profile-img-main rounded">
                                                <img src="{{ asset($admins->avatar) }}" alt="img"
                                                    class="m-0 p-1 rounded hrem-6">
                                            </div>

                                            <div class="ms-4">
                                                <strong>{{ $admins->fullname }}</strong>
                                                <p class="text-muted mb-2">Đăng Nhập: {{ $admins->login_at }}</p>

                                                <a href="" class="btn btn-primary btn-sm"><i class="fa fa-envelope"></i>
                                                    {{ ($admins->email) }}</a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="border-top">
                                <div class="wideget-user-tab">
                                    <div class="tab-menu-heading">
                                        <div class="tabs-menu1">
                                            <ul class="nav">
                                                <li>
                                                    <a href="#profileMain" class="active show"
                                                        data-bs-toggle="tab">Thông Tin Chung
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#editProfile" data-bs-toggle="tab">
                                                        Chỉnh Sửa Thông Tin
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-content">
                            <div class="tab-pane active show" id="profileMain">
                                <div class="card">
                                    <div class="card-body p-0">
                                        <div class="border-top"></div>
                                        <div class="table-responsive p-5">
                                            <table class="table row table-borderless">
                                                <tbody class="col-lg-12 col-xl-6 p-0">
                                                    <tr>
                                                        <td><strong>Họ Và Tên :</strong> {{ $admins->fullname }}</td>
                                                    </tr>
                                                    <td>
                                                        <strong>Ngày Sinh :</strong> {{ $admins->birth_date }}
                                                    </td>
                                                    <tr>
                                                        <td>
                                                            <strong>Giới Tính :</strong> {{ $admins->genders->name }}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                <tbody class="col-lg-12 col-xl-6 p-0 border-top-0">
                                                    <tr>
                                                        <td>
                                                            <strong>Chức Vụ :</strong> {{ $admins->roles->name }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <strong>Trạng Thái :</strong> {{ $admins->status->name }}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="border-top"></div>
                                        <div class="p-5">
                                            <h3 class="card-title">Thông Tin Liên Hệ</h3>
                                            <div class="d-sm-flex">
                                                <div>
                                                    <div class="main-profile-contact-list">
                                                        <div class="media mx-2">
                                                            <div class="media-icon bg-primary-transparent text-primary">
                                                                <i class="fe fe-phone fs-21"></i>
                                                            </div>
                                                            <div class="media-body ms-2">
                                                                <span class="text-muted">Số Điện Thoại</span>
                                                                <p class="mb-0"> {{ $admins->phone_number }} </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="main-profile-contact-list">
                                                        <div class="media mx-2">
                                                            <div class="media-icon bg-info-transparent text-info">
                                                                <i class="fe fe-map-pin fs-21"></i>
                                                            </div>
                                                            <div class="media-body ms-2">
                                                                <span class="text-muted">Địa Chỉ</span>
                                                                <p class="mb-0"> {{ $admins->address }} </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="editProfile">
                                <div class="card">
                                    <div class="card-body border-0">
                                        <form class="form-horizontal" method="POST" enctype="multipart/form-data"
                                            action="{{ route('admins.updateProfile') }}">
                                            @csrf
                                            <div class="row mb-4">
                                                <div class="col-md-12 col-lg-12 col-xl-6">
                                                    <label class="form-label">Quản Trị</label>

                                                    <div class="input-group input-group-merge">
                                                        <input type="text" name="fullname"
                                                            value="{{ $admins->fullname }}" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="col-md-12 col-lg-12 col-xl-6">
                                                    <label class="form-label">Email</label>

                                                    <div class="input-group input-group-merge">
                                                        <input type="email" name="email" value="{{ $admins->email }}"
                                                            class="form-control">
                                                    </div>
                                                </div>

                                                <div class="col-md-12 col-lg-12 col-xl-6">
                                                    <label class="form-label">Địa Chỉ</label>

                                                    <textarea class="form-control" name="address"
                                                        placeholder="">{{ $admins->address }}</textarea>

                                                </div>

                                                <div class="col-md-12 col-lg-12 col-xl-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Điện Thoại</label>

                                                        <div class="input-group input-group-merge">
                                                            <input type="number" name="phone_number"
                                                                value="{{ $admins->phone_number }}"
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 col-lg-12 col-xl-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Ngày Sinh </label>

                                                        <div class="input-group input-group-merge">
                                                            <input type="date" name="birth_date"
                                                                value="{{ $admins->birth_date }}" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 col-lg-12 col-xl-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Tài Khoản</label>

                                                        <div class="input-group input-group-merge">
                                                            <input type="text" name="username"
                                                                value="{{ $admins->username }}" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 col-lg-12 col-xl-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Mật Khẩu </label>

                                                        <div class="input-group input-group-merge">
                                                            <input type="password" name="password"
                                                                value="{{ $admins->password }}" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 col-lg-12 col-xl-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Giới Tính</label>

                                                        <select name="genders_id" class="form-select">
                                                            @foreach ($genders as $gender)
                                                            <option value="{{ $gender->id }}" @if ($gender->id ==
                                                                $admins->genders_id) selected @endif>
                                                                {{ $gender->name }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="mb-3">
                                                <div class="col-sm-10">
                                                    <button type="submit" class="btn btn-primary">Cập Nhật</button>
                                                    <a href="{{ route('admins.profile') }}"
                                                        class="btn btn-outline-secondary">Trở Lại</a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection