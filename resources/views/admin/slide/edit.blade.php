@extends('admin.layout.index')


@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Slide
                    <small>Edit</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                @if (session('notification'))
                    <div class="alert alert-success">
                        {{session('notification')}}
                    </div>
                @endif
                <form action="admin/slide/edit/{{$slide->id}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                    <label>Tên Slide</label>
                        <input class="form-control" name="Ten" value="{{$slide->Ten}}" />
                        @error('Ten')
                            <small class="form-text text-danger text-uppercase alert">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Hình Ảnh</label>
                        <img width="400px" src="upload/slide/{{$slide->Hinh}}" alt="">
                        <input type="file" name="Hinh" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Nội Dung</label>
                        <input class="form-control" name="NoiDung" value="{{$slide->NoiDung}}" />
                        @error('NoiDung')
                            <small class="form-text text-danger text-uppercase alert">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Link</label>
                        <input class="form-control" name="Link" value="{{$slide->link}}" />
                        @error('Link')
                            <small class="form-text text-danger text-uppercase alert">{{ $message }}</small>
                        @enderror
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