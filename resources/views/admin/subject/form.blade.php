@section('css')
    <link href="css/plugins/chosen/bootstrap-chosen.css" rel="stylesheet">
@endsection
<div class="form-group">
    {!! Form::label('name', 'Mã học phần: ', ['class' => 'control-label']) !!}
    {!! Form::text('mmc_subjectid', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('name', 'Tên học phần: ', ['class' => 'control-label']) !!}
    {!! Form::text('mmc_subjectname', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('tinchi', 'Số tín lý thuyết: ', ['class' => 'control-label']) !!}
    {!! Form::number('mmc_theory', null, ['class' => 'form-control','step'=>'any']) !!}
</div>
<div class="form-group">
    <label>Khóa:</label>
    <br>
    <select data-placeholder="Khóa" class="chosen-select " name="mmc_khoa[]" multiple style="width:350px;" tabindex="4">
        @for($i=14;$i<21;$i++)
            @if(isset($subject->k) && in_array("K".$i, $subject->k))
                <option value="{{"K".$i}}" selected>K{{$i}}</option>
            @else
                 <option value="{{"K".$i}}" >K{{$i}}</option>
            @endif
       @endfor
    </select>
    {{-- <select name="mmc_nguoinhan[]" class="mdb-select md-form" multiple size="24" >
        <br>
        @foreach($department as $item)
            <optgroup label="{{$item->mmc_deptname}}">
                @foreach($employee as $employeeitem)
                    @if($employeeitem->mmc_deptid == $item->mmc_deptid)
                        <option value="{{$employeeitem->mmc_employeeid}}">{{$employeeitem->mmc_name}}</option>

                    @endif
                @endforeach
            </optgroup>
        @endforeach
    </select> --}}
</div>
<div class="form-group">
    {!! Form::label('tinchi', 'Số tín thực hành: ', ['class' => 'control-label']) !!}
    {!! Form::number('mmc_practice', null, ['class' => 'form-control','step'=>'any']) !!}
</div>
<div class="form-group">
    {!! Form::label('description', 'Mô tả: ', ['class' => 'control-label']) !!}
    {!! Form::text('mmc_description', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Sửa' : 'Thêm mới', ['class' => 'btn btn-primary']) !!}
</div>
@section('scripts')

    <script src="js/plugins/chosen/chosen.jquery.js"></script>

    <script>
        $(document).ready(function(){
            $('.chosen-select').chosen({width: "100%"});
        });

    </script>
@endsection
