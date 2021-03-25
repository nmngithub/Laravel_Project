@extends('admin.layout.index')


@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Tin Tức
                    
                    <small>{{$Detail->TieuDe}}</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                @if (count($errors)>0)
                    @foreach ($errors->all() as $err)
                        <div class="alert alert-danger">
                            {{$err}} <br>
                        </div>
                    @endforeach
                @endif

                @if (session('notification'))
                    <div class="alert alert-success">
                        {{session('notification')}}
                    </div>
                @endif

                <form action="admin/detail/edit/{{$Detail->id}}" method="POST" enctype="multipart/form-data">
                    @csrf
                   
                    <div class="form-group">
                        <label>Tiêu Đề</label>
                        <textarea name="TieuDe" class="form-control">
                            {{$Detail->TieuDe}}
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label>Tóm Tắt</label>
                        <textarea name="TomTat" class="form-control" rows="3">
                            {{$Detail->TomTat}}
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label>Nội Dung</label>
                        <textarea name="NoiDung" class="form-control"  rows="5">
                            {{$Detail->NoiDung}}
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label>Hình Ảnh</label>
                        <img width="400px" src="upload/tintuc/{{$Detail->Hinh}}" alt="">
                        <input type="file" name="Hinh" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Nổi Bật</label>
                        <label class="radio-inline">
                            <input
                            name="NoiBat" value="0" 
                            @if ($Detail->NoiBat == 0)
                                {{'checked'}}
                            @endif type="radio">Không
                        </label>
                        <label class="radio-inline">
                            <input name="NoiBat"
                            @if ($Detail->NoiBat == 1)
                                {{'checked'}}
                            @endif
                            value="1" type="radio">Có
                        </label>
                    </div>
                    <button type="submit" class="btn btn-default">Save</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                <form>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>
@endsection