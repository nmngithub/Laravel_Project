@extends('admin.layout.index')


@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Slide
                    <small>Add</small>
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

                @if (session('thongbao'))
                    <div class="alert alert-success">
                        {{session('thongbao')}}
                    </div>
                @endif

                <form action="admin/slide/them" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Tên Slide</label>
                        <input class="form-control" name="Ten" placeholder="Nhập tên slide" />
                    </div>
                    <div class="form-group">
                        <label>Hình Ảnh</label>
                        <input type="file" name="Hinh" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Nội Dung</label>
                        <input class="form-control" name="NoiDung" placeholder="Nhập nội dung" />
                    </div>
                    <div class="form-group">
                        <label>Link</label>
                        <input class="form-control" name="Link" placeholder="Nhập Link" />
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
