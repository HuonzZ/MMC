@extends('layouts.backend')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Quản lý Ngành</h2>
            <span><a href="{{route('home')}}">Home</a> > Quản lý ngành </span>
        </div>
    </div>
    <div class="wrapper wrapper-content  animated fadeInRight blog">
        @if (Session::has('flash_message'))
            <div class="container col-md-12 error">
                <div class="alert alert-success">
                    {{ Session::get('flash_message') }}
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">Ngành</div>
                    <div class="card-body">
                        <a href="{{route('major.create')}}" class="btn btn-primary btn-sm" title="Thêm mới ngành">
                            <i class="fa fa-plus" aria-hidden="true"></i> Thêm mới
                        </a>
                        {!! Form::open(['method' => 'GET', 'url' => '/admin/major', 'class' => 'form-inline my-2 my-lg-0 float-right', 'role' => 'search'])  !!}
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Tìm kiếm...">
                            <span class="input-group-btn">
                                <button class="btn btn-secondary" type="submit" style="margin-bottom: 0px;">
                                    <i class="fa fa-search" ></i>
                                </button>
                            </span>
                        </div>
                        {!! Form::close() !!}
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table" id="major">
                                <thead>
                                <tr>
                                    <th>Mã Ngành</th>
                                    <th>Tên Ngành</th>
                                    <th>Bộ Môn</th>
                                    <th>Màu</th>
                                    <th>Mô Tả</th>
                                    <th>Chức năng</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($major as $item)
                                <tr>
                                    <td>{{$item->mmc_majorid}}</td>
                                    <td data-toggle="modal" data-target="#myModal" style="cursor:pointer">{{$item->mmc_majorname}}</td>
                                    <td>{{App\Http\Controllers\Admin\MajorController::getDepartment($item->mmc_deptid)}}</td>
                                    <td style="background-color: rgb({{$item->r}}, {{$item->g}}, {{$item->b}},0.7);"></td>  
                                    <td>{{$item->mmc_description}}</td>
                                    <td>
                                        <a href="{{ url('/admin/major/'.$item->id.'/edit') }}" title="Sửa thông tin ngành"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>
                                        {!! Form::open([
                                            'method' => 'DELETE',
                                            'url' => ['/admin/major',$item->id],
                                            'style' => 'display:inline'
                                        ]) !!}
                                        {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', array(
                                                'type' => 'submit',
                                                'class' => 'btn btn-danger btn-sm',
                                                'title' => 'Xóa ngành',
                                                'onclick'=>'return confirm("Xác nhận xóa ngành cùng các dữ liệu liên quan?")'
                                        )) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination justify-content-center"> {!! $major->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@section('scripts')
    <script>
        $(document).ready(function() {
            $("#major").on("click", "td:nth-child(2)", function() {
                selectVal = $(this).text();
                $.ajax({
                    method: "POST",
                    url: "{{route('ajaxgeteducation')}}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "name": selectVal},
                    success : function ( data ) {

                        $('#mmc_education').html(data);
                    }
                })
            });
        });
    </script>
@endsection
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Chương trình đào tạo thuộc ngành  </h4>
            </div>
            <div class="modal-body" id="mmc_education">
            </div>
            <div class="modal-footer">
            </div>
        </div>

    </div>
</div>
@endsection

