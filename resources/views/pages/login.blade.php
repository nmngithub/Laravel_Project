@extends('layout.index')

@section('content')
    <!-- Page Content -->
    <div class="container">

    	<!-- slider -->
    	<div class="row carousel-holder">
    		<div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="panel panel-default">
				  	<div class="panel-heading">Đăng nhập</div>
				  	<div class="panel-body">

                    @if (session('notification'))
                        <div class="alert alert-danger">
                            {{session('notification')}}
                        </div>
                    @endif
				    	<form action="login" method="POST">
                            @csrf
							<div>
				    			<label>Email</label>
							  	<input type="email" class="form-control" placeholder="Email" name="email" value="{{old('email')}}">
                                @error('email')
                                    <small class="text-danger text-uppercase alert">{{$message}}</small>
                                @enderror
                            </div>
							<br>	
							<div>
				    			<label>Mật khẩu</label>
							  	<input type="password" class="form-control" name="password">
                                  @error('password')
                                      <small class="text-danger text-uppercase alert">{{$message}}</small>
                                  @enderror
							</div>
							<br>
							<button type="submit" class="btn btn-default">Đăng nhập
							</button>
				    	</form>
				  	</div>
				</div>
            </div>
            <div class="col-md-4"></div>
        </div>
        <!-- end slide -->
    </div>
    <!-- end Page Content -->
@endsection