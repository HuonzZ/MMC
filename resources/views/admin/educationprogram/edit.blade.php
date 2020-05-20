@extends('layouts.backend')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Quản lý chương trình đào tạo</h2>
            <span><a href="{{route('home')}}">Home</a> > <a href="{{route('educationprogram.index')}}">Quản lý chương trình đào tạo</a> > Thêm mới  </span>
        </div>
    </div>
    <div class="wrapper wrapper-content  animated fadeInRight blog">
        @if (Session::has('flash_message'))
            <div class="error">
                <div class="alert alert-success">
                    {{ Session::get('flash_message') }}
                </div>
            </div>
        @endif
        @if ($errors->any())
            <ul class="alert alert-danger" style="list-style: none">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">Thêm mới CTĐT</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/educationprogram') }}" title="Back"><button class="btn btn-primary btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Quay lại</button></a>
                        <a href="{{route('subject.create')}}" class="btn btn-primary btn-sm" title="Thêm mới môn học">
                            <i class="fa fa-plus" aria-hidden="true"></i> Thêm mới
                        </a>
                        {!! Form::model($course, [
                           'method' => 'PATCH',
                           'url' => ['/admin/educationprogram', $course->id],
                           'class' => 'form-horizontal',
                           'files' => true
                                ]) !!}

                        @include ('admin.educationprogram.form2', ['formMode' => 'edit'])

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

