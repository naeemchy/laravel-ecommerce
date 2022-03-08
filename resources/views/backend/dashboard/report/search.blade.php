@extends('backend.app')

@section('title','Search Report')

@push('css')
    <!-- JQuery DataTable Css -->
    <link href="{{ asset('backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="container-fluid">
        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-4">
        	 	   <div class="card pd-20 pd-sm-40">
			          <div class="table-wrapper">
			            <form method="post" action="{{ route('admin.search.by.date') }}" >
			              @csrf
			              <div class="modal-body pd-20">
			                <div class="form-group">
			                  <label for="exampleInputEmail1">Search By Date</label>
			                  <input type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  name="date" required="">
			                </div>
			              </div><!-- modal-body -->
			              <div class="modal-footer">
			                <button type="submit" class="btn btn-info pd-x-20">submit</button>
			              </div>
			            </form>
			          </div><!-- table-wrapper -->
			        </div><!-- card -->
        	 </div>

        	  <div class="col-lg-4">
        	 	    <div class="card pd-20 pd-sm-40">
			          <div class="table-wrapper">
			            <form method="post" action="{{ route('admin.search.by.month') }}" >
			              @csrf
			              <div class="modal-body pd-20">
			                <div class="form-group">
			                  <label for="exampleInputEmail1">Search By Month</label>
			                 <select class="form-control" name="month">
			                 	 <option value="January">January</option>
			                 	 <option value="February">February</option>
			                 	 <option value="March">March</option>
			                 	 <option value="April">April</option>
			                 	 <option value="May">May</option>
			                 	 <option value="June">June</option>
			                 	 <option value="July">July</option>
			                 	 <option value="August">August</option>
			                 	 <option value="September">September</option>
			                 	 <option value="October">October</option>
			                 	 <option value="November">November</option>
			                 	 <option value="December">December</option>
			                 </select>
			                </div>
			              </div><!-- modal-body -->
			              <div class="modal-footer">
			                <button type="submit" class="btn btn-info pd-x-20">submit</button>
			              </div>
			            </form>
			          </div><!-- table-wrapper -->
			        </div><!-- card -->
        	 </div>

        	  <div class="col-lg-4">
        	 	    <div class="card pd-20 pd-sm-40">
			          <div class="table-wrapper">
			            <form method="post" action="{{ route('admin.search.by.year') }}" enctype="multipart/form-data">
			              @csrf
			              <div class="modal-body pd-20">
			                <div class="form-group">
			                  <label for="exampleInputEmail1">Search By Year</label>
			                   <select class="form-control" name="year">
			                 	 <option value="2018">2018</option>
			                 	 <option value="2019">2019</option>
			                 	 <option value="2020">2020</option>
			                 	 <option value="2021">2021</option>
			                 	 <option value="2022">2022</option>
			                 	 <option value="2023">2023</option>
			                 	 <option value="2024">2024</option>
			                 	 <option value="2025">2025</option>
			                 	 <option value="2026">2026</option>
			                 	 <option value="2027">2027</option>
			                 	 <option value="2028">2028</option>
			                 	 <option value="2029">2029</option>
			                 	  <option value="2030">2030</option>
			                 </select>
			                </div>
			              </div><!-- modal-body -->
			              <div class="modal-footer">
			                <button type="submit" class="btn btn-info pd-x-20">submit</button>
			              </div>
			            </form>
			          </div><!-- table-wrapper -->
			        </div><!-- card -->
        	 </div>
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
@endpush