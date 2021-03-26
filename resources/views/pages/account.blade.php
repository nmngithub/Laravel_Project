@extends('layout.index')
@section('content')
     <!-- Page Content -->
     <div class="container">
    	<!-- slider -->
    	<div class="row carousel-holder">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
                <div class="panel panel-default">
				  	<div class="panel-heading">Thông tin tài khoản</div>
                      @if (count($errors)>0)
                          @foreach ($errors->all() as $item)
                              <div class="alert alert-danger">
                                  {{$item}}
                              </div>
                          @endforeach
                      @endif

                      @if (session('thongbao'))
                          <div class="alert alert-success">
                              {{session('thongbao')}}
                          </div>
                      @endif
				  	<div class="panel-body">
				    	<form action="account" method="POST">
                            @csrf
				    		<div>
				    			<label>Họ tên</label>
							  	<input type="text" class="form-control" name="name" aria-describedby="basic-addon1" value="{{Auth::user()->name}}">
							</div>
							<br>
							<div>
				    			<label>Email</label>
							  	<input type="email" class="form-control" name="email" aria-describedby="basic-addon1"
							  	disabled value="{{Auth::user()->email}}"
							  	>
							</div>
							<br>	
							<div>
				    			<label>Đổi mật khẩu</label>
							  	<input type="password" class="form-control" name="password" aria-describedby="basic-addon1">
							</div>
							<br>
							<div>
				    			<label>Nhập lại mật khẩu</label>
							  	<input type="password" class="form-control" name="passwordAgain" aria-describedby="basic-addon1">
							</div>
							<br>
							<button type="submit" class="btn btn-default">Save
							</button>

				    	</form>
				  	</div>
				</div>
            </div>
            <div class="col-md-2">
            </div>
        </div>
        <!-- end slide -->
    </div>
    <!-- end Page Content -->
@endsection