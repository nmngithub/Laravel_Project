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
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Tiêu Đề</th>
                        <th>Tóm Tắt</th>
                        <th>Thể Loại</th>
                        <th>Loại Tin</th>
                        <th>Nổi Bật</th>
                        <th>Delete</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($tintuc as $item)
                        <tr class="odd gradeX" align="center">
                            <td>{{$item->id}}</td>
                            <td>
                                <p>{{$item->TieuDe}}</p>
                                <img src="upload/tintuc/{{$item->Hinh}}" width="100px" alt="">
                            </td>
                            <td>{{$item->TomTat}}</td>
                            <td>{{$item->loaitin->theloai->Ten}}</td>
                            <td>{{$item->loaitin->Ten}}</td>
                            <td>
                                @if ($item->NoiBat == 0)
                                    {{'Không'}}
                                @else
                                    {{'Có'}}
                                @endif
                            </td>

                            <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin.theloai.xoa"> Delete</a></td>
                            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin.theloai.sua">Edit</a></td>
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
