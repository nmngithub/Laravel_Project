@extends('admin.layout.index')

@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Uers
                    <small>List</small>
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
                        <th>Email</th>
                        <th>Quyen</th>
                        <th>Block Or Not</th>
                        <th>Delete</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $stt=1 ?>
                    @foreach ($users as $item)
                        <tr class="odd gradeX" align="center">
                            <td>{{$stt}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->email}}</td>
                            <td>
                                @if ($item->quyen == 1)
                                    {{"Admin"}}
                                @else
                                    {{"User"}}
                                @endif
                            </td>
                            <td>
                                @if ($item->block == 1)
                                    {{"Block"}}
                                @else
                                    {{"Not Block"}}
                                @endif
                            </td>
                            <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/account/delete/{{$item->id}}"> Delete</a></td>
                            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/account/edit/{{$item->id}}">Edit</a></td>
                        </tr>
                        <?php $stt++ ?>
                    @endforeach
                    
    
                </tbody>
            </table>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
@endsection
