@extends('admin.layout.index')

@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
  
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Thể Loại
                    <small>Danh Sách</small>
                </h1>
            </div>
            @if (session('notification'))
            <div class="alert alert-success">
                {{session('notification')}}
            </div>
            @endif
            <!-- /.col-lg-12 -->
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Delete</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody> 
                    <?php $stt=1; ?>
                    @foreach ($Category as $item)
                        <tr class="odd gradeX" align="center">
                            <td>{{$stt}}</td>
                    <?php $stt++; ?>
                            <td>{{$item->Ten}}</td>
                            <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/category/delete/{{$item->id}}">Delete</a></td>
                            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/category/edit/{{$item->id}}">Edit</a></td>
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
