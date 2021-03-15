@extends('admin.layout.index')

@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Tin Tức
                    <small>List</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            @if (session('thongbao'))
                <div class="alert alert-success">
                    {{session('thongbao')}}
                </div>
            @endif

            <table class="table table-striped table-bordered table-hover" id="">
                <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Tin Tức ID</th>
                        <th>User ID</th>
                        <th>Nội Dung</th>
                        <th>Delete</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $stt = 1; ?>
                    @foreach ($comment as $item)
                        <tr class="odd gradeX" align="center">
                            <td>{{$stt}}</td>
                            <td>
                                <p>{{$item->TinTuc_id}}</p>
                                <img src="upload/tintuc/{{$item->Hinh}}" width="100px" alt="">
                            </td>
                            <td>{{$item->User_id}}</td>
                            <td>{{$item->NoiDung}}</td>

                            <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/tintuc/xoa/{{$item->id}}"> Delete</a></td>
                            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/tintuc/sua/{{$item->id}}">Edit</a></td>
                        </tr>
                        <?php $stt++; ?>
                    @endforeach
                    
                   
    
                </tbody>
            </table>
        </div>
        <!-- /.row -->
        {{$tintuc->links()}}
    </div>
    <!-- /.container-fluid -->
</div>
@endsection
