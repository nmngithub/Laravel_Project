@extends('admin.layout.index')

@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Loại Tin
                    <small>{{$KindOfNews->Ten}}</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">

                @if (session('notification'))
                    <div class="alert alert-success">
                        {{session('notification')}}
                    </div>
                @endif

                <form action="admin/kindofnews/edit/{{$KindOfNews->id}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Thể Loại</label>
                        <select class="form-control" name="IdTheLoai">
                            @foreach ($Category as $item)
                                <option
                                @if ($KindOfNews->IdTheLoai == $item->id)
                                    {{"Selected"}}
                                @endif
                                 value="{{$item->id}}">{{$item->Ten}}</option>
                            @endforeach
                        </select>
                        @error('IdTheLoai')
                            <small class="form-text text-danger text-uppercase alert">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Tên Loại Tin</label>
                        <input class="form-control" name="Ten" placeholder="Nhập tên loại tin" value="{{$KindOfNews->Ten}}" />
                    @error('Ten')
                        <small class="form-text text-danger text-uppercase alert">{{ $message }}</small>
                    @enderror
                    </div>
                    <button type="submit" class="btn btn-default">Save</button>
                <form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
@endsection
