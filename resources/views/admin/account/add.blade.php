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
                @if (session('notification'))
                    <div class="alert alert-success">
                        {{session('notification')}}
                    </div>
                @endif
                <form action="admin/account/add" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Tên Người Dùng</label>
                        <input class="form-control" name="Ten" value="{{old('Ten')}}" placeholder="Nhập Tên Người Dùng" />
                        @error('Ten')
                            <small class="form-text text-danger text-uppercase alert">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="Email" value="{{old('Email')}}" placeholder="Nhập Email" />
                        @error('Email')
                            <small class="form-text text-danger text-uppercase alert">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>PassWord</label>
                        <input type="password" class="form-control" name="password" placeholder="Nhập PassWord" />
                        @error('password')
                            <small class="form-text text-danger text-uppercase alert">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Nhập Lại PassWord</label>
                        <input type="password" class="form-control" name="passwordAgain" placeholder="Nhập Lại PassWord" />
                        @error('passwordAgain')
                            <small class="form-text text-danger text-uppercase alert">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Quyền Người Dùng</label>
                        <label class="radio-inline">
                            <input name="quyen" value="0" checked="" {{old('quyen')=="0" ? 'checked='.'"checked"':''}} type="radio">User
                        </label>
                        <label class="radio-inline">
                            <input name="quyen" value="1" type="radio" {{old('quyen')=="1" ? 'checked='.'"checked"':''}}>Admin
                        </label>
                    </div>
                    <div class="form-group">
                        <label>Block Or Not</label>
                        <label class="radio-inline">
                            <input name="block" value="0" checked="" {{old('block')=="0" ? 'checked='.'"checked"':''}} type="radio">Not Block
                        </label>
                        <label class="radio-inline">
                            <input name="block" value="1" type="radio" {{old('block')=="1" ? 'checked='.'"checked"':''}}>Block
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
