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

            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Tin Tức ID</th>
                        <th>User Name</th>
                        <th>Nội Dung</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php $stt = 1; ?>
                    @foreach ($comment as $item)              
                            <tr class="odd gradeX" align="center">
                                <td>{{$stt}}</td>
                                <td>
                                    <p>{{$item->TinTuc_TieuDe}}</p>
                                </td>
                               
                                <td>
                                    {{$item['User_Name']}}
                                </td>
                               
                                <td>{{$item->NoiDung}}</td>

                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/comment/xoa/{{$item->id}}"> Delete</a></td>
                            </tr>
                            <?php $stt++; ?>
                       
                    @endforeach
                    
                   
    
                </tbody>
            </table>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
@endsection
