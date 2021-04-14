@extends('admin.layout.index')


@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Tin Tức
                    <small>Add</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">

                @if (session('notification'))
                    <div class="alert alert-success">
                        {{session('notification')}}
                    </div>
                @endif

                <form action="admin/detail/add" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Thể Loại</label>
                        <select class="form-control" name="IdTheLoai" id="IdTheLoai">
                            @foreach ($Category as $item)
                                <option value="{{$item->id}}" @if (old('IdTheLoai') == $item->id) selected="selected" @endif>{{$item->Ten}}</option>
                            @endforeach
                        </select>
                        @error('IdTheLoai')
                            <small class="form-text text-danger text-uppercase alert">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Loại Tin</label>
                        <select class="form-control" name="IdLoaiTin" id="IdLoaiTin">
                            @foreach ($KindOfNews as $item)
                                <option value="{{$item->id}}" @if (old('IdLoaiTin') == $item->id) selected="selected" @endif>{{$item->Ten}}</option>
                            @endforeach
                        </select>
                        @error('IdLoaiTin')
                            <small class="form-text text-danger text-uppercase alert">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Tiêu Đề</label>
                        <textarea name="TieuDe" class="form-control" rows="3">
                            {{{ old('TieuDe') }}}
                        </textarea>
                        @error('TieuDe')
                            <small class="form-text text-danger text-uppercase alert">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Tóm Tắt</label>
                        <textarea name="TomTat" class="form-control" rows="3">
                            {{{ old('TomTat') }}}
                        </textarea>
                        @error('TomTat')
                            <small class="form-text text-danger text-uppercase alert">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Nội Dung</label>
                        <textarea name="NoiDung" class="form-control" rows="5">
                            {{{ old('NoiDung') }}}
                        </textarea>
                        @error('NoiDung')
                            <small class="form-text text-danger text-uppercase alert">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Hình Ảnh</label>
                        <input type="file" name="Hinh" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Nổi Bật</label>
                        <label class="radio-inline">
                            <input name="NoiBat" value="0" checked='' {{ old('NoiBat')=="0" ? 'checked='.'"checked"' : '' }} type="radio">Không
                        </label>
                        <label class="radio-inline">
                            <input name="NoiBat" value="1"  {{ old('NoiBat')=="1" ? 'checked='.'"checked"' : '' }} type="radio">Có
                        </label>
                    </div>
                    <button type="submit" class="btn btn-default">Save</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                <form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
@endsection