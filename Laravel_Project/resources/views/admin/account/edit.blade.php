@extends('admin.layout.index')


@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">User
                    <small>Add</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                @if (count($errors)>0)
                    <div class="alert alert-danger">
                    @foreach ($errors->all() as $err)
                            {{$err}} <br>
                    @endforeach
                    </div>
                @endif

                @if (session('notification'))
                    <div class="alert alert-success">
                        {{session('notification')}}
                    </div>
                @endif
                <form action="admin/account/edit/{{$users->id}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Tên Người Dùng</label>
                        <input class="form-control" name="Ten" value="{{$users->name}}" />
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="Email" value="{{$users->email}}" />
                    </div>
                    <div class="form-group">
                        <label>PassWord</label>
                        <input type="password" class="form-control" name="password" placeholder="Nhập PassWord" />
                    </div>
                    <div class="form-group">
                        <label>Nhập Lại PassWord</label>
                        <input type="password" class="form-control" name="passwordAgain" placeholder="Nhập Lại PassWord" />
                    </div>
                    <div class="form-group">
                        <label>Quyền Người Dùng</label>
                        <label class="radio-inline">
                            <input 
                            @if ($users->quyen == 0)
                                {{'checked'}}
                            @endif
                            name="quyen" value="0" type="radio">User
                        </label>
                        <label class="radio-inline">
                            <input
                            @if ($users->quyen == 1)
                                {{'checked'}}
                            @endif
                            name="quyen" value="1" type="radio">Admin
                        </label>
                    </div>
                    <div class="form-group">
                        <label>Block Or Not</label>
                        <label class="radio-inline">
                            <input 
                            @if ($users->block == 0)
                                {{'checked'}}
                            @endif
                            name="block" value="0" type="radio">Not Block
                        </label>
                        <label class="radio-inline">
                            <input
                            @if ($users->block == 1)
                                {{'checked'}}
                            @endif
                            name="block" value="1" type="radio">Block
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
