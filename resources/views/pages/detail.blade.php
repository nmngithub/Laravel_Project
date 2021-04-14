@extends('layout.index')

@section('content')
    
  <!-- Page Content -->
  <div class="container">
    <div class="row">

        <!-- Blog Post Content Column -->
        <div class="col-lg-9">
            <!-- Blog Post -->

            <!-- Title -->
            <h1>{{$Detail->TieuDe}}</h1>
            <!-- Author -->
            <p class="lead">
                by <a href="#">Admin</a>
            </p>

            <!-- Preview Image -->
            <img class="img-responsive" src="upload/tintuc/{{$Detail->Hinh}}" alt="">

            <!-- Date/Time -->
                <p>
                    <span class="glyphicon glyphicon-time"></span> 
                    Posted on {{$Detail->created_at}}
                </p>
                <hr>
            <!-- Post Content -->
            <p class="lead">{{$Detail->TomTat}}</p>
            <p>{!!$Detail->NoiDung!!}</p>

            <hr>

            <!-- Blog Comments -->
            @if (session('notification'))
            <div class="alert alert-success">
                {{session('notification')}}
            </div>
            @endif
             <!-- Comments Form -->
             <div class="well">
                <h4>Viết bình luận ...<span class="glyphicon glyphicon-pencil"></span></h4>
                <form role="form" action="comment/{{$Detail->_id}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <textarea class="form-control" name="NoiDung" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Gửi</button>
                </form>
            </div>

            <hr>

            <!-- Posted Comments -->

            <!-- Comment -->
            @foreach ($showinfo as $item)
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">{{$item['User_Name']}}
                        <small>{{$item['created_at']}}</small>
                    </h4>
                    {{$item['NoiDung']}}
                </div>
            </div>
            @endforeach
        </div>

        <!-- Blog Sidebar Widgets Column -->
        <div class="col-md-3">
           @if(count($tinlienquan)>0)
            <div class="panel panel-default">
                <div class="panel-heading"><b>Tin liên quan</b></div>
                <div class="panel-body">
                    <!-- item -->
                    @foreach ($tinlienquan->sortByDesc('created_at') as $item)
                    <div class="row" style="margin-top: 10px;text-align: left">
                        <div class="col-md-5">
                            <a href="detail/{{$item->_id}}">
                                <img class="img-responsive" src="upload/tintuc/{{$item->Hinh}}" alt="">
                            </a>
                        </div>
                        <div class="col-md-7"  style="height: 70px; padding:0">
                            <a href="detail/{{$item->_id}}"><h6 style="margin-top: 0;margin-right: 10px;"><b>{{$item->TieuDe}}</b></a>
                        </div>
                        <p style="padding: 0px 15px;">{{$item->TomTat}}</p>
                        <div class="break"></div>
                    </div>
                    @endforeach
                    <!-- end item -->
                </div>
            </div>              
            @endif
            @if(count($tinnoibat)>0)
            <div class="panel panel-default">
                <div class="panel-heading"><b>Tin nổi bật</b></div>
                <div class="panel-body">
                    @foreach ($tinnoibat as $item)
                    <!-- item -->
                    <div class="row" style="margin-top: 10px; text-align: left">
                        <div class="col-md-5">
                            <a href="detail/{{$item->_id}}">
                                <img class="img-responsive" src="upload/tintuc/{{$item->Hinh}}" alt="">
                            </a>
                        </div>
                        <div class="col-md-7" style="height: 62px; padding:0">
                            <a href="detail/{{$item->_id}}"><h6 style="margin-top: 0;margin-right: 10px;"><b>{{$item->TieuDe}}</b></h6></a>
                        </div>
                        <p style="padding: 0px 15px;">{{$item->TomTat}}</p>
                        <div class="break"></div>
                    </div>
                    <!-- end item -->
                    @endforeach
                </div>
            </div>
            @endif
            
        </div>

    </div>
    <!-- /.row -->
</div>
<!-- end Page Content -->

@endsection