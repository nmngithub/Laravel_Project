@extends('admin.layout.index')


@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Thể Loại
                    <small>Add</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">

                @if (session('notification'))

                <div class="alert alert-success">
                    {{session('notification')}} <br>
                </div> 
                @endif

                <form action="admin/category/add" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Tên Thể Loại</label>
                        <input class="form-control" name="Ten" placeholder="Nhập tên thể loại" value="{{old('Ten')}}"/>
                        @error('Ten')
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