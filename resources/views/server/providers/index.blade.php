@extends('server.master')

@section('content')

<div class="page-header">

    <div class="ms-auto pageheader-btn">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Nhà Cung Cấp</a></li>
            <li class="breadcrumb-item active" aria-current="page">Danh Sách</li>
        </ol>
    </div>

</div>

<div class="row">
    <div class="col-12 col-sm-12">
        <div class="card product-sales-main">
            <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                <div>
                    <a href="{{route('providers.create')}}" class="btn btn-primary me-2">Thêm</a>

                    <a href="{{route('providers.trash')}}" class="btn btn-primary me-2">Thùng Rác</a>
                    <a href="{{route('providers.pdf')}}" class="btn btn-primary me-2">Xem PDF</a>
                </div>

                <div class="input-group input-group-merge w-50">
                    <span class="input-group-text"><i class="ti-search"></i></span>
                    <input type="text" id="search" class="form-control" placeholder="Tìm kiếm..."
                        aria-label="Search...">
                </div>
            </div>
            <div class="card-header border-bottom">
                <form action="{{route('providers.import-excel')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group" style="width: 600px">
                        <input type="file" name="import_file" class="form-control">
                        <button type="submit" class="btn btn-primary me-5">Nhập Excel</button>
                    </div>
                </form>
                <form action="{{route('providers.export-excel')}}" method="GET">
                    <div class="input-group" style="width: 600px">
                        <select name="type" class="form-control" required>
                            <option value="">Chọn định dạng</option>
                            <option value="xlsx">XLSX</option>
                            <option value="xls">XLS</option>
                            <option value="csv">CSV</option>
                        </select>
                        <button type="submit" class="btn btn-primary me-5">Xuất Excel</button>
                    </div>
                </form>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table id="listProviders" class="table text-nowrap mb-0 table-bordered">
                        <thead class="table-head">
                            <tr>
                                <th>STT</th>
                                <th>Nhà Cung Cấp</th>
                                <th>Địa Chỉ</th>
                                <th>Điện Thoại</th>
                                <th>Trạng Thái</th>
                                <th>Chức Năng</th>
                            </tr>
                        </thead>
                        <tbody class="table-body">
                            @include('server.providers.search')
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('admin_template/assets/jquery-3.7.1.min.js') }}"></script>
<script>
    var $j = jQuery.noConflict();

    $j(document).ready(function() {
        $j('#search').on('keyup', function(event) {
            if (event.key === 'Enter') {
                searchProviders();
            }
        });
    });

    function searchProviders() {
        let keyword = $j('#search').val();

        $j.ajax({
            url: "{{ route('providers.search') }}",
            type: 'POST',
            data: {
                data: keyword,
                _token: '{{ csrf_token() }}'
            },
            success: function(data) {
                $j('#listProviders tbody').html(data);
            },
            error: function(xhr) {
                console.error(xhr.responseText);
            }
        });
    }
</script>

@endsection