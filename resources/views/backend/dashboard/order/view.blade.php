@extends('backend.app')

@section('title','Singel Order Show')

@push('css')
    <!-- JQuery DataTable Css -->
    <link href="{{ asset('backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="container-fluid">
        <!-- Exportable Table -->
        <div class="row clearfix">
        <!-- Task Info -->
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="header">
                    <h2>Order Details</h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-hover dashboard-task-infos">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Payment</th>
                                    <th>Payment ID</th>
                                    <th>Total</th>
                                    <th>Month </th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $order->name }}</td>
                                    <td>{{ $order->phone }}</td>
                                    <td><span class="label bg-green">{{ $order->payment_type }}</span></td>
                                    <td>{{ $order->payment_id }}</td>
                                    <td>{{ $order->total }}.00Tk</td>
                                    <td>{{ $order->month }}</td>
                                    <td>{{ $order->date }}</td>
                                    
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Task Info -->
        <!-- Browser Usage -->
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="header">
                    <h2>Shipping Details</h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-hover dashboard-task-infos">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>City</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $shipping->ship_name }}</td>
                                    <td>{{ $shipping->ship_phone }}</td>
                                    <td>{{ $shipping->ship_email }}</td>
                                    <td>{{ $shipping->ship_address }}</td>
                                    <td>{{ $shipping->ship_city }}</td>
                                    <td>
                                        @if($order->status == 0)
                                            <span class="badge badge-warning">Pending</span>
                                        @elseif($order->status == 1)
                                            <span class="badge badge-info">Payment Acceptd</span>
                                        @elseif($order->status == 2) 
                                            <span class="badge badge-info">Progressing</span>
                                        @elseif($order->status == 3)  
                                            <span class="badge badge-success">Delevered </span>
                                        @else
                                            <span class="badge badge-danger">Canceled </span>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="header">
                    <h2>Product Details</h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-hover dashboard-task-infos">
                            <thead>
                                <tr>
                                    <th>Product ID</th>
                                    <th>Product Name</th>
                                    <th>Image</th>
                                    <th>Color</th>
                                    <th>Size</th>
                                    <th>Quantity</th>
                                    <th>Buy Get One</th>
                                    <th>Unit Price</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($details as $row)
                                    <tr>
                                        <td>{{ $row->product_code }}</td>
                                        <td>{{ $row->product_name }}</td> 
                                        <td><img src="{{ asset('storage/product/'.$row->image_one)}}" height="80px;" width="80px;" style="border-radius: 50%;"></td>
                                        <td>{{ $row->color }}</td> 
                                        <td>{{ $row->size }}</td> 
                                        <td>{{ $row->quantity }}</td>
                                        @if($row->buyone_getone)
                                            <td><span class="badge badge-warning">Yes </span></td>
                                        @else
                                            <td><span class="badge badge-info">No</span></td>
                                        @endif
                                        <td>{{ $row->singleprice }}.00Tk</td>
                                        <td>{{ $row->totalprice }}.00Tk</td>                                  
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="header">
                    <h2>Action</h2>
                </div>
                <div class="body">
                    @if($order->status == 0)
                        <a href="{{ route('admin.order.accept',$order->id) }}" class="btn btn-info">Payment Accept</a>
                        <button class="btn btn-danger" type="button" onclick="orderCancel({{ $order->id }})">
                            Cancel Order
                        </button>
                        <form id="cancel-order-{{ $order->id }}" action="{{ route('admin.order.cancel',$order->id) }}" method="post" style="display: none;">
                            @csrf
                            @method('PUT')
                        </form>
                    @elseif($order->status == 1)
                        <a href="{{ route('admin.order.delevery.progress',$order->id) }}" class="btn btn-info">Delevery Progress</a>
                        <strong> Payment Already Checked and pass here for delevery request</strong>
                    @elseif($order->status == 2)
                        <a href="{{ route('admin.order.delevery.done',$order->id) }}" class="btn btn-success">Delevered Done</a>
                        <strong> Payment Already done your product are handover successfully</strong>
                    @elseif($order->status == 4)
                        <strong class="text-danger">This order are not valid its canceled</strong>
                    @else
                        <strong class="text-success">This product are succesfully delevered</strong>
                    @endif
                </div>
            </div>
        </div>
        <!-- #END# Browser Usage -->
    </div>
        <!-- #END# Exportable Table -->
    </div>
@endsection

@push('js')
    <!-- Jquery DataTable Plugin Js -->
    <script src="{{ asset('backend/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>

    <script src="{{ asset('backend/js/pages/tables/jquery-datatable.js') }}"></script>
    <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
    <script type="text/javascript">
        function orderCancel(id) {
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('cancel-order-'+id).submit();
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swal(
                        'Cancelled',
                        'Your data is safe :)',
                        'error'
                    )
                }
            })
        }
    </script>
@endpush