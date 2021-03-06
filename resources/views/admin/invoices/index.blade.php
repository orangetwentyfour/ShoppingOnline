@extends('layout_admin.master')
@section('head-meta')
    <meta name="csrf" content="{{csrf_token()}}">
@endsection
@section('content')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Invoices</a>
        </li>
        <li class="breadcrumb-item active">List</li>
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

    <div id="success_alert" class="row pt-2 px-3">
        <div class="alert alert-success col-12">
            <button type="button" class="close success">&times;</button>
            <span data-bind="success"></span>
        </div>
    </div>

    <div id="error_alert" class="row pt-2 px-3">
        <div class="alert alert-danger col-12">
            <button type="button" class="close error">&times;</button>
            <span data-bind="error"></span>
        </div>
    </div>

    <!-- DataTables Example -->
    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i>
            {{__('Danh sách hóa đơn')}}
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>{{__('STT')}}</th>
                        <th>{{__('Mã đơn hàng')}}</th>
                        <th>{{__('Số lượng sản phẩm')}}</th>
                        <th>{{__('Thành tiền(VNĐ)')}}</th>
                        <th>{{__('Trạng thái')}}</th>
                        <th>{{__('Ngày mua')}}</th>
                        <th>{{__('Người mua')}}</th>
                        <th>{{__('Thao tác')}}</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>{{__('STT')}}</th>
                        <th>{{__('Mã đơn hàng')}}</th>
                        <th>{{__('Số lượng sản phẩm')}}</th>
                        <th>{{__('Thành tiền(VNĐ)')}}</th>
                        <th>{{__('Trạng thái')}}</th>
                        <th>{{__('Ngày mua')}}</th>
                        <th>{{__('Người mua')}}</th>
                        <th>{{__('Thao tác')}}</th>
                    </tr>
                    </tfoot>
                    <tbody id="data-table">
                    @foreach($invoices as $invoice)
                        <tr>
                            <td>{{$loop->index + 1}}</td>
                            <td>{{'BUY'.$invoice->id}}</td>
                            <td>{{$invoice->totalItems}}</td>
                            <td>{{money($invoice->amount . '000')}}</td>
                            <td>
                                @if ($status == constants('CART.STATUS.PENDING'))
                                    <span class="badge badge-warning">
                                @elseif($status == constants('CART.STATUS.ON_THE_WAY'))
                                            <span class="badge badge-primary">
                                @elseif($status == constants('CART.STATUS.TRANSPORTED'))
                                    <span class="badge badge-warning">
                                @elseif($status == constants('CART.STATUS.PAID'))
                                                    <span class="badge badge-success">
                                @else
                                                            <span class="badge badge-danger">
                                @endif
                                                                {{$invoice->status}}
                                    </span>
                            </td>
                            <td>{{$invoice->created_at}}</td>
                            <td>{{$invoice->owner}}</td>

                            <td>
                                <div class="d-flex">
                                    <a href="{{route('invoices.detail', $invoice->id)}}"
                                       class="btn btn-primary show-detail rounded-0">
                                        <i class="fa fa-eye text-white"></i>
                                    </a>
                                    @if ($status == constants('CART.STATUS.PENDING')
                                        || $status == constants('CART.STATUS.ON_THE_WAY')
                                    )
                                        <a href="{{route('invoices.update-status')}}" data-approve="invoice"
                                           data-id="{{$invoice->id}}" class="btn btn-success rounded-0">
                                            <i class="fa fa-check text-white"></i>
                                        </a>
                                    @endif
                                    @if ($status == constants('CART.STATUS.PENDING')
                                        || $status == constants('CART.STATUS.ON_THE_WAY')
                                        || $status == constants('CART.STATUS.TRANSPORTED')
                                    )
                                        <a href="" data-id="{{$invoice->id}}" class="btn btn-del btn-danger rounded-0"
                                           data-toggle="modal"
                                           data-target="#dialog-del">
                                            <i class="fa fa-trash text-white"></i>
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="d-flex justify-content-center pb-4">
            {{$invoices->links()}}
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
    </div>
    <div class="modal" id="dialog-del">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">{{__('Thông báo')}}</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    {{__('Bạn có chắc chắn muốn hủy đơn hàng?')}}
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Không</button>
                    <form action="{{route('invoices.cancel', -1)}}" method="post">
                        @csrf
                        <input type="hidden" value="delete" name="_method">
                        <input type="hidden" value="approve" name="type">
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
        $(document).ready(function () {
            $('#error_alert').hide();
            $('#success_alert').hide();
            $(document).on('click', 'button.close.error', function () {
                $('#error_alert').hide();
            });
            $(document).on('click', 'button.close.success', function () {
                $('#success_alert').hide();
            });
            @if ($status == constants('CART.STATUS.PENDING')
                || $status == constants('CART.STATUS.ON_THE_WAY')
            )
            /**
             *  confirm invoice
             */
            $(document).on('click', 'a[data-approve]', function (e) {
                e.preventDefault();
                var url = $(this).attr('href');
                var urlDetail = $(this).parent().find('a.show-detail').attr('href');
                var id = $(this).attr('data-id');
                var type = $(this).attr('data-approve');
                var CSRF_TOKEN = $('meta[name="csrf"]').attr('content');

                $.ajax({
                    method: 'post',
                    url: url,
                    contentType: 'application/json',
                    dataType: 'json',
                    data: JSON.stringify({
                        id: id,
                        type: type,
                        _token: CSRF_TOKEN,
                        _method: 'PATCH'
                    }),
                    success: function (response) {
                        $('#error_alert').hide();
                        $('#success_alert').show();
                        $('#success_alert span[data-bind="success"]').text(response.message);
                        var tmp_data = '';
                        response.data.data.forEach(function (item, index) {
                            var template = '<tr>' +
                                '    <td>:index</td>' +
                                '    <td>:id</td>' +
                                '    <td>:quantity</td>' +
                                '    <td>:amount</td>' +
                                '    <td>:status</td>' +
                                '    <td>:created_at</td>' +
                                '    <td>:owner</td>' +
                                '    <td>' +
                                '       <div class="d-flex">' +
                                '           <a href=":urlDetail" class="btn btn-primary rounded-0">' +
                                '               <i class="fa fa-eye text-white"></i>' +
                                '           </a>' +
                                '           <a href=":url" data-approve="invoice" data-id=":id" class="btn btn-success rounded-0">' +
                                '               <i class="fa fa-check text-white"></i>' +
                                '           </a>' +
                                '           <a href="" data-id=":id" class="btn btn-del btn-danger rounded-0" data-toggle="modal"' +
                                '               data-target="#dialog-del">' +
                                '               <i class="fa fa-trash text-white"></i>' +
                                '           </a>' +
                                '       </div>' +
                                '    </td>' +
                                '</tr>';
                            template = template.replace(':index', index + 1);
                            template = template.replace(':id', item.id);
                            template = template.replace(':id', item.id);
                            template = template.replace(':id', item.id);
                            template = template.replace(':quantity', item.quantity);
                            template = template.replace(':amount', item.amount);
                            template = template.replace(':status', item.status);
                            template = template.replace(':created_at', item.created_at.substr(0, 10));
                            template = template.replace(':owner', item.owner.name);
                            template = template.replace(':urlDetail', urlDetail);
                            template = template.replace(':url', url);
                            tmp_data += template;
                        });
                        $('#data-table').html(tmp_data);
                    },
                    error: function (err) {
                        $('#error_alert').show();
                        $('#success_alert').hide();
                        $('#error_alert span[data-bind="error"]').text(err.responseJSON.message);
                    }
                })
            })
            @endif
        });
    </script>
    @if ($status == constants('CART.STATUS.PENDING')
        || $status == constants('CART.STATUS.ON_THE_WAY')
        || $status == constants('CART.STATUS.TRANSPORTED')
    )
    <script src="{{asset('js/admin/delete-dialog.js')}}"></script>
    @endif
@endsection
