@extends('layout.index')

@section('content')
        <!-- Page Content -->
    <div class="container">
        <div class="row">
            @include('layout.menu')

            <div class="col-md-9 ">
                <div class="panel panel-default">
                    @foreach ($loaitin as $item)
                        <div class="panel-heading" style="background-color:#337AB7; color:white;">
                            <h4><b>{{$item->Ten}}</b></h4>
                        </div>
                    @endforeach
                 
                    @foreach ($tintuc->sortByDesc('created_at') as $item)
                        <div class="row-item row">
                            <div class="col-md-3">

                                <a href="detail/{{$item->_id}}">
                                    <br>
                                    <img width="200px" height="200px" class="img-responsive" src="upload/tintuc/{{$item->Hinh}}" alt="">
                                </a>
                            </div>

                            <div class="col-md-9">
                                <h3>{{$item->TieuDe}}</h3>
                                <p>{{$item->TomTat}}</p>
                                <a class="btn btn-primary" href="detail/{{$item->_id}}">Xem Thêm<span class="glyphicon glyphicon-chevron-right"></span></a>
                            </div>
                            <div class="break"></div>
                        </div>
                    @endforeach
                    <!-- Pagination -->
                    <div class="row text-center">
                                    <b>{{$tintuc->links()}}</b>
                    </div>
                    <!-- /.row -->

                </div>
            </div> 

        </div>

    </div>
    <!-- end Page Content -->
@endsection