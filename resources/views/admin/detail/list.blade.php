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
            @if (session('notification'))
                <div class="alert alert-success">
                    {{session('notification')}}
                </div>
            @endif

            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Tiêu Đề</th>
                        <th>Tóm Tắt</th>
                        <th>Nội Dung</th>
                        <th>Thể Loại</th>
                        <th>Loại Tin</th>
                        <th>Nổi Bật</th>
                        <th>Delete</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $stt = 1; ?>
                    @foreach ($Detail as $item)
                        <tr class="odd gradeX" align="center">
                            <td>{{$stt}}</td>
                            <td>
                                <p>{{$item->TieuDe}}</p>
                                <img src="upload/tintuc/{{$item->Hinh}}" width="100px" alt="">
                            </td>
                            <td>{{$item->TomTat}}</td>
                            <td>{{$item->NoiDung}}</td>
                            <td>{{$item->TheLoai}}</td>
                            <td>{{$item->LoaiTin}}</td>
                            <td>
                                @if ($item->NoiBat == 0)
                                    {{'Không'}}
                                @else
                                    {{'Có'}}
                                @endif
                            </td>

                            <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/detail/delete/{{$item->id}}"> Delete</a></td>
                            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/detail/edit/{{$item->id}}">Edit</a></td>
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
