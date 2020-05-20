<div class="row">
<div class="col-lg-6">
<div class="input-group mb-3 input-group-sm">
    <div class="input-group-prepend">
        <span class="input-group-text">Ngành: <b class="b-color-red">&nbsp;&nbsp;*</b></span>
    </div>
    {!! Form::select('mmc_majorid', $major, null, ['class' => 'form-control']) !!}
</div>
</div>
<div class="col-lg-6">
    <div class="input-group mb-3 input-group-sm">
        <div class="input-group-prepend">
            <span class="input-group-text">Bắt đầu áp dụng khóa: <b class="b-color-red">&nbsp;&nbsp;*</b></span>
        </div>
        <input type="text" name="mmc_course" class="form-control" required oninvalid="this.setCustomValidity('Không được bỏ trống')" oninput="this.setCustomValidity('')" value="{{ old('mmc_course') }}">
    </div>
</div>
</div>
<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Sửa' : 'Thêm mới', ['class' => 'btn btn-primary']) !!}
</div>


