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
                @foreach ($Category as $itemCat)
                    @if(isset($KON[$itemCat->id]))
                        <div class="row-item row">
                            <h3>
                                <a href="/">{{$itemCat->Ten}}</a> |
                                    @foreach ($KON[$itemCat->id] as $itemKON)
                                    <small><a href="kindofnews/{{$itemKON}}"><i>{{$itemKON}}</i></a>/</small>
                                    @endforeach	
                            </h3>
                            
                            <?php 
                                    $data = $Detail->where('IdTheLoai',$itemCat->id)->sortByDesc('created_at')->take(4);
                                    $oneNews = $data->shift();
                            ?>

                
                            <div class="col-md-8 border-right">
                                @if(isset($oneNews))
                                <div class="col-md-5">
                                    <a href="detail/{{$oneNews['_id']}}">
                                        <img class="img-responsive" src="upload/tintuc/{{$oneNews['Hinh']}}" alt="">
                                    </a>
                                </div>

                                <div class="col-md-7">
                                    <h3>{{$oneNews['TieuDe']}}</h3>
                                    <p>{{$oneNews['TomTat']}}</p>
                                    <a class="btn btn-primary" href="detail/{{$oneNews['_id']}}">Xem Thêm<span class="glyphicon glyphicon-chevron-right"></span></a>
                                </div>
                                @endif
                            </div>
                            

                            <div class="col-md-4">
                                @foreach ($data->sortByDesc('created_at') as $itemData)
                                <a href="detail/{{$itemData->_id}}">
                                    <h4>
                                        <span class="glyphicon glyphicon-list-alt"></span>
                                        {{$itemData->TieuDe}}
                                    </h4>
                                </a>
                                @endforeach
                            </div>
                            
                            <div class="break"></div>
                        </div>
                    @endif
                @endforeach
                    <!-- end item -->
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
</div>
@endsection
