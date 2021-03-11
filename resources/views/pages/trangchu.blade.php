@extends('layout.index')

@section('content')
<div class="container">

    @include('layout.slide')

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
                    {{-- @foreach ($theloai as $tl)
                        @if (count($tl->loaitin)>0) --}}
                        <div class="row-item row">
                            <h3>
                                {{-- <a href="#">{{$tl->Ten}}</a> | 	 --}}
                                {{-- @foreach ($tl->loaitin as $lt) --}}
                                <small><a href=""><i></i></a>/</small>  
                                {{-- @endforeach --}}
                            </h3>
                            {{-- <?php 
                                $data = $tl->tintuc->where('NoiBat',1)->sortByDesc('created_at')->take(5);
                                $tin1 = $data->shift();
                            ?> --}}
                            <div class="col-md-8 border-right">
                                {{-- @if (isset($tin1)) --}}
            
                                <div class="col-md-5">
                                    <a href="">
                                        <img class="img-responsive" src="" alt="">
                                    </a>
                                </div>
                                                        
                                <div class="col-md-7"> 
                                    <h3 style="margin-top: 0"></h3>
                                    <p></p>
                                    <a class="btn btn-primary" href="">Xem Thêm <span class="glyphicon glyphicon-chevron-right"></span></a>
                                </div>
                                {{-- @endif --}}
                            </div>
                            

                            <div class="col-md-4">
                               {{-- @if (isset($data))
                                   @foreach ($data->all() as $dt) --}}
                                       
                                <a href="">
                                    <h4>
                                        <span class="glyphicon glyphicon-list-alt"></span>
                                        {{-- {{$dt->TieuDe}} --}}
                                    </h4>
                                </a>

                                    {{-- @endforeach

                                @endif --}}
                            </div>
                            
                            <div class="break"></div>
                        </div>
                        {{-- @endif
                    @endforeach --}}
                    <!-- end item -->

                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
</div>
@endsection
