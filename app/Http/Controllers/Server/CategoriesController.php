<?php

namespace App\Http\Controllers\Server;

use App\Models\Categories;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\CategoriesExport;
use App\Imports\CategoriesImport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\StoreCategoriesRequest;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listCategories = Categories::all()->where('is_deleted', 1);

        return view('server.categories.index', compact('listCategories'));
    }

    public function trash()
    {
        $listCategories = Categories::all()->where('is_deleted', 0);

        return view('server.categories.trash', compact('listCategories'));
    }

    public function search(Request $req)
    {
        $keyword = $req->input('data');

        $listCategories = Categories::where('name', 'like', "%$keyword%")->where('is_deleted', 1)->get();

        return view('server.categories.search', compact('listCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categories::all();

        return view('server.categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoriesRequest $req)
    {
        $categories = new Categories();

        $categories->name = $req->name;
        $categories->is_deleted = 1;

        $categories->save();

        return redirect()->route('categories.index')->with('alert', 'Thêm danh mục thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(Categories $categories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $categories = Categories::find($id);

        $is_deleted = [
            (object) ['id' => 0, 'name' => 'Đã hết'],
            (object) ['id' => 1, 'name' => 'Đang còn']
        ];

        return view('server.categories.update', compact('categories', 'is_deleted'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req, $id)
    {
        $categories = Categories::find($id);

        if (empty($categories)) {
            return redirect()->route('categories.index')->with('alert', 'Danh mục không tồn tại!!');
        }

        $categories->name = $req->name;
        $categories->is_deleted = $req->is_deleted;

        $categories->save();

        return redirect()->route('categories.index')->with('alert', 'Cập nhật danh mục thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $categories = Categories::find($id);

        if (!$categories) {
            return redirect()->route('categories.index')->with('alert', 'Danh mục không tồn tại!!');
        }

        if ($categories->is_deleted == 0) {
            return redirect()->route('categories.index')->with('alert', 'Danh mục đã được xóa trước đó rồi!!');
        }

        $categories->is_deleted = 0;
        $categories->save();

        return redirect()->route('categories.index')->with('alert', 'Xóa danh mục thành công');
    }

    public function viewPDF()
    {
        $categories = Categories::all();

        $pdf = PDF::loadView('server.categories.pdf',  compact('categories'));

        return $pdf->stream('Danh Mục Giày.pdf');
    }

    public function importExcel(Request $re)
    {

        Excel::import(new CategoriesImport, $re->file('import_file'));

        return redirect()->route('categories.index')->with('alert', "Nhập dữ liệu của danh mục giày thành công");
    }

    public function exportExcel(Request $re)
    {
        if ($re->type == 'xlsx') {

            $files = 'xlsx';
            $format = \Maatwebsite\Excel\Excel::XLSX;
        } elseif ($re->type == 'xls') {

            $files = 'xls';
            $format = \Maatwebsite\Excel\Excel::XLS;
        } elseif ($re->type == 'csv') {

            $files = 'csv';
            $format = \Maatwebsite\Excel\Excel::CSV;
        }

        $filename = "Danh Mục Giày" . "." . $files;

        return Excel::download(new CategoriesExport, $filename, $format);
    }
}
