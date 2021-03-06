@extends('layouts.backend')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Quản lý Bộ môn</h2>
            <span><a href="{{route('home')}}">Home</a> > Quản lý bộ môn</span>
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
                    <div class="card-header">Bộ môn</div>
                    <div class="card-body">
                        <a href="{{route('department.create')}}" class="btn btn-primary btn-sm" title="Thêm bộ môn">
                            <i class="fa fa-plus" aria-hidden="true"></i> Thêm mới
                        </a>

                        {!! Form::open(['method' => 'GET', 'url' => '/admin/department', 'class' => 'form-inline my-2 my-lg-0 float-right', 'role' => 'search'])  !!}
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Tìm kiếm...">
                            <span class="input-group-btn">

                                <button class="btn btn-secondary" type="submit" style=" margin-bottom: 0px;">
                                    <i class="fa fa-search" ></i>
                                </button>
                            </span>
                        </div>
                        {!! Form::close() !!}
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table" id="department">
                                <thead>
                                <tr>
                                    <th>Tên bộ môn</th>
                                    <th>Mô tả</th>
                                    <th>Chức năng</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($department as $item)
                                    <tr>
                                        <td data-toggle="modal" data-target="#myModal"  style="cursor:pointer">{{$item->mmc_deptname}}</td>
                                        <td>{{$item->mmc_description}}</td>
                                        <td>
                                            <a href="{{ url('/admin/department/'.$item->id.'/edit') }}" title="Sửa thông tin bộ môn"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>
                                            {!! Form::open([
                                                'method' => 'DELETE',
                                                'url' => ['/admin/department',$item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', array(
                                                    'type' => 'submit',
                                                    'class' => 'btn btn-danger btn-sm',
                                                    'title' => 'Xóa bộ môn',
                                                    'onclick'=>'return confirm("Xác nhận xóa bộ môn cùng các dữ liệu liên quan?")'
                                            )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination justify-content-center"> {!! $department->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@section('scripts')
    <script>
        $(document).ready(function() {
            $("#department").on("click", "td:nth-child(1)", function() {
              selectVal = $(this).text();
                $.ajax({
                    method: "POST",
                    url: "{{route('ajaxgetmajor')}}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "name": selectVal},
                    success : function ( data ) {

                        $('#mmc_major').html(data);
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
                    <h4 class="modal-title">Thông tin bộ môn  </h4>
                </div>
                <div class="modal-body" id="mmc_major">
                </div>
                <div class="modal-footer">
                </div>
            </div>

        </div>
    </div>
@endsection

