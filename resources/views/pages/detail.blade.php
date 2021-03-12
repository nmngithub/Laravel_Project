@extends('layout.index')

@section('content')
    
  <!-- Page Content -->
  <div class="container">
    <div class="row">

        <!-- Blog Post Content Column -->
        <div class="col-lg-9">
            <!-- Blog Post -->

            <!-- Title -->
            <h1>{{$tintuc->TieuDe}}</h1>
            <!-- Author -->
            <p class="lead">
                by <a href="#">Admin</a>
            </p>

            <!-- Preview Image -->
            <img class="img-responsive" src="upload/tintuc/{{$tintuc->Hinh}}" alt="">

            <!-- Date/Time -->
        
            @if (isset($tintuc->created_at) || $tintuc->created_at != "NULL")
                <p>
                    <span class="glyphicon glyphicon-time"></span> 
                    Posted on {{$tintuc->created_at}}
                </p>
                <hr>
            @endif
            <!-- Post Content -->
            <p class="lead">{{$tintuc->TomTat}}</p>
            <p>{!!$tintuc->NoiDung!!}</p>

            <hr>

            <!-- Blog Comments -->

            <!-- Comments Form -->
            <div class="well">
                <h4>Viết bình luận ...<span class="glyphicon glyphicon-pencil"></span></h4>
                <form role="form">
                    <div class="form-group">
                        <textarea class="form-control" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Gửi</button>
                </form>
            </div>

            <hr>

            <!-- Posted Comments -->

            <!-- Comment -->
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">Start Bootstrap
                        <small>August 25, 2014 at 9:30 PM</small>
                    </h4>
                    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                </div>
            </div>

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <div class="col-md-3">
           
            <div class="panel panel-default">
                <div class="panel-heading"><b>Tin liên quan</b></div>
                <div class="panel-body">
                    <!-- item -->
                    @foreach ($tinlienquan as $item)
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-md-5">
                            <a href="detail/{{$item->_id}}">
                                <img class="img-responsive" src="upload/tintuc/{{$item->Hinh}}" alt="">
                            </a>
                        </div>
                        <div class="col-md-7">
                            <a href="detail/{{$item->_id}}"><b>{{$item->TieuDe}}</b></a>
                        </div>
                        <p>{{$item->TomTat}}</p>
                        <div class="break"></div>
                    </div>
                    @endforeach
                    <!-- end item -->
                </div>
            </div>              
         

            <div class="panel panel-default">
                <div class="panel-heading"><b>Tin nổi bật</b></div>
                <div class="panel-body">
                    @foreach ($tinnoibat as $item)
                    <!-- item -->
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-md-5">
                            <a href="detail/{{$item->_id}}">
                                <img class="img-responsive" src="upload/tintuc/{{$item->Hinh}}" alt="">
                            </a>
                        </div>
                        <div class="col-md-7">
                            <a href="detail/{{$item->_id}}"><b>{{$item->TieuDe}}</b></a>
                        </div>
                        <p>{{$item->TomTat}}</p>
                        <div class="break"></div>
                    </div>
                    <!-- end item -->
                    @endforeach
                </div>
            </div>
            
        </div>

    </div>
    <!-- /.row -->
</div>
<!-- end Page Content -->

@endsection