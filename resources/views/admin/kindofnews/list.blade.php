@extends('admin.layout.index')

@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Loại Tin
                    <small>Danh Sách</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            @if (session('notification'))
                <div class="alert alert-success">
                    {{session('notification')}}
                </div>
            @endif
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Thể Loại</th>
                        <th>Delete</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $stt=1; ?>
                    @foreach ($KindOfNews as $item)
                        <tr class="odd gradeX" align="center">
                            <td>{{$stt}}</td>
                    <?php $stt++; ?>
                            <td>{{$item->Ten}}</td>
                            @foreach ($Category as $item1)
                            @if ($item->IdTheLoai == $item1->_id)
                            <td>{{$item1->Ten}}</td>                
                            @endif    
                            @endforeach
                            <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/kindofnews/delete/{{$item->id}}">Delete</a></td>
                            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/kindofnews/edit/{{$item->id}}">Edit</a></td>
                        </tr>
                    @endforeach
                    
    
                </tbody>
            </table>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
@endsection
