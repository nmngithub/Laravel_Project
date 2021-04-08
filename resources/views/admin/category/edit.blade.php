@extends('admin.layout.index')

@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Thể Loại Edit
                    <small>{{$Category->Ten}}</small>
                 
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">

              @if (session('notification'))
                  <div class="alert alert-success">
                      {{session('notification')}}
                  </div>
              @endif
                <form action="admin/category/edit/{{$Category->id}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Tên Thể Loại</label>
                        <input class="form-control" name="Ten" placeholder="Điền tên thể loại" value="{{$Category->Ten}}" />
                    @error('Ten')
                        <small class="form-text text-danger text-uppercase alert">{{ $message }}</small>
                    @enderror
                    </div>
                    
                    
                    <button type="submit" class="btn btn-default">Lưu</button>
                <form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
@endsection
