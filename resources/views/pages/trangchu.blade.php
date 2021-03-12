@extends('layout.index')

@section('content')
<div class="container">

    <!-- slider -->
    @include('layout.slide')
    <!-- end slide -->

    <div class="space20"></div>


    <div class="row main-left">
       
        @include('layout.menu')

        <div class="col-md-9">
            <div class="panel panel-default">            
                <div class="panel-heading" style="background-color:#337AB7; color:white;" >
                    <h2 style="margin-top:0px; margin-bottom:0px;">Laravel Tin Tức</h2>
                </div>

                <div class="panel-body">
                    <!-- item -->
                @foreach ($theloai as $item1)
                    <div class="row-item row">
                        <h3>
                            <a href="#">{{$item1->Ten}}</a> | 
                            @foreach ($lt[$item1->Ten] as $item2)
                            <small><a href="category/{{$item2}}"><i>{{$item2}}</i></a>/</small>
                            @endforeach	
                        </h3>

                        <?php 
                                $data = $tintuc->where('TheLoai',$item1->Ten)->sortByDesc('_id')->take(4);
                                $tin1 = $data->shift();
                        ?>

               
                        <div class="col-md-8 border-right">
                            @if(isset($tin1))
                            <div class="col-md-5">
                                <a href="detail/{{$tin1->id}}/{{$tin1->TieuDeKhongDau}}.html">
                                    <img class="img-responsive" src="upload/tintuc/{{$tin1['Hinh']}}" alt="">
                                </a>
                            </div>

                            <div class="col-md-7">
                                <h3>{{$tin1['TieuDe']}}</h3>
                                <p>{{$tin1['TomTat']}}</p>
                                <a class="btn btn-primary" href="detail/{{$tin1['_id']}}">Xem Thêm<span class="glyphicon glyphicon-chevron-right"></span></a>
                            </div>
                            @endif
                        </div>
                        
                        {{-- @dump($data) --}}

                        <div class="col-md-4">
                            @foreach ($data as $item)
                            <a href="detail/{{$item->_id}}">
                                <h4>
                                    <span class="glyphicon glyphicon-list-alt"></span>
                                    {{$item->TieuDe}}
                                </h4>
                            </a>
                            @endforeach
                        </div>
                        
                        <div class="break"></div>
                    </div>
                @endforeach
                    <!-- end item -->
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
</div>
@endsection
