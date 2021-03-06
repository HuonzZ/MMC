<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\mmc_department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 5;

        if (!empty($keyword)) {
            $department = mmc_department::where('mmc_deptname', 'LIKE', "%$keyword%")->latest()->paginate($perPage);
        } else {
            $department = mmc_department::latest()->paginate($perPage);
        }
        return view('admin.department.index', compact('department'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.department.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'mmc_deptname'=>'required|unique:mmc_departments,mmc_deptname',
        ],[
            'mmc_deptname.required'=>'Tên bộ môn không được bỏ trống',
            'mmc_deptname.unique'=>'Tên bộ môn đã tồn tại'

        ]);
        $id  = DB::table('mmc_departments')->max('id');
        $id = $id + 1;
        if($id<10){
            $departmentid  = "MMC_".$id;
        }else{
            $departmentid  = "MMC_".$id;
        }
        $department=new mmc_department();
        $department->mmc_deptid=$departmentid;
        $department->mmc_deptname=$request->mmc_deptname;
        $department->mmc_description=$request->mmc_description;
        $department->save();
        return redirect('admin/department')->with('flash_message', 'Thêm mới thành công!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $department = mmc_department::findOrFail($id);
        return view('admin.department.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'mmc_deptname'=>'required|unique:mmc_departments,mmc_deptname,'.$id,
        ],[
            'mmc_deptname.required'=>'Tên bộ môn hông được bỏ trống',
            'mmc_deptname.unique'=>'Tên bộ môn đã tồn tại'
        ]);
        $requestData = $request->all();
        $department = mmc_department::findOrFail($id);
        $department->update($requestData);
        return redirect('admin/department')->with('flash_message', 'Sửa thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        mmc_department::where('id', $id)->update(array('status' => '0'));
        return redirect('admin/department')->with('flash_message', 'Xóa thành công!');
    }
}
