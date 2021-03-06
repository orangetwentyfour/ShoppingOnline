@extends('layout_admin.master')
@section('content')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">{{_('Categories')}}</a>
        </li>
        <li class="breadcrumb-item active">{{_('List')}}</li>
    </ol>

    @if($message = Session::get('success'))
    <div class="row pt-2 px-3">
            <div class="alert alert-success col-12">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                {{$message}}
            </div>
    </div>
    @endif

    @if($message = Session::get('error'))
        <div class="row pt-2 px-3">
            <div class="alert alert-danger col-12">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                {{$message}}
            </div>
        </div>
    @endif

    <div class="d-flex mb-3">
        <a href="{{route('categories.create')}}" class="btn btn-primary">
            {{_('Thêm danh mục')}}
        </a>
    </div>

    <!-- DataTables Example -->
    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i>
            {{_('Danh sách danh mục sản phẩm')}}
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>{{__('STT')}}</th>
                        <th>{{__('Danh mục')}}</th>
                        <th>{{__('Số sản phẩm')}}</th>
                        <th>{{__('Ngày tạo')}}</th>
                        <th>{{__('Người tạo')}}</th>
                        <th>{{__('Thao tác')}}</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>{{__('STT')}}</th>
                        <th>{{__('Danh mục')}}</th>
                        <th>{{__('Số sản phẩm')}}</th>
                        <th>{{__('Ngày tạo')}}</th>
                        <th>{{__('Người tạo')}}</th>
                        <th>{{__('Thao tác')}}</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($categories as $key => $category)
                        <tr id="1">
                            <td id="1">
                                <a data-toggle="collapse" data-target="#child{{$category->id}}">
                                    {{ $loop->index + 1 }}
                                </a>
                            </td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->count_products }}</td>
                            <td>{{ $category->created_at }}</td>
                            <td>{{ $category->user->name }}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{route('categories.edit', $category->id)}}" class="btn btn-success rounded-0">
                                        <i class="fa fa-edit text-white"></i>
                                    </a>
                                    <a href="" data-id="{{$category->id}}" class="btn btn-del btn-danger rounded-0" data-toggle="modal" data-target="#dialog-del">
                                        <i class="fa fa-trash text-white"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @foreach($category->children as $child)
                            <tr id="child{{$category->id}}" class="collapse bg-light">
                                <td>{{ ($key + 1) . "." . ($loop->index + 1) }}</td>
                                <td>{{ $child->name }}</td>
                                <td>{{ $child->count_products }}</td>
                                <td>{{ $child->created_at }}</td>
                                <td>{{ $child->user->name }}</td>
                                <td>
                                    <a href="{{route('categories.edit', $child->id)}}" class="btn btn-success">
                                        <i class="fa fa-edit text-white"></i>
                                    </a>
                                    <a href="" data-id="{{$child->id}}" class="btn btn-del btn-danger" data-toggle="modal" data-target="#dialog-del">
                                        <i class="fa fa-trash text-white"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="d-flex justify-content-center pb-4">
            {{$categories->links()}}
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
    </div>

    <div class="modal" id="dialog-del">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Thông báo</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    Bạn có chắc chắn muốn xóa?
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Không</button>
                    <form action="{{route('categories.destroy', -1)}}" method="post">
                        @csrf
                        <input type="hidden" value="delete" name="_method">
                        <input type="hidden" value="" name="del-id">
                        <input type="submit" class="btn btn-success" value="{{__('Có')}}">
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $(document).on('click', 'td', function (e) {
                if (e.target !== this){
                    return;
                }
                // console.log('ok')
                $(this).parent('tr').find('td:eq(0) a').click();
            });
        });
    </script>
    <script src="{{asset('js/admin/delete-dialog.js')}}"></script>
@endsection
