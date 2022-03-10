@extends('layout.admin')
@section('content')
<div class="pagetitle">

    <div class="row">
        <div class="col-md-6">
            <h1>Categories</h1>
           
        </div>
        <div class="col-md-6">
        <span style="float:right"><a href="{{ route('category.create') }}"><button type="button" id="usercreate" class="btn btn-primary"> Create </button></a></span>
        </div>
</div>
    </div><!--jhjh End Page Title -->
    <div class="modal fade" id="largeModal" tabindex="-1">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                  @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                    </div>
                    <br>
                    @endif
                    <div class="modal-header">
                      <h5 class="modal-title">Create Category</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
              
               <form id="frmModalForm" name="frmModalForm" onsubmit="return false;" enctype="multipart-data">
               @csrf
                 <div class="row">
                    <div class="col-md-6" >
                        <div class="form-group">
                            <label class="form-label">Name<span class="required">*</span></label>
                                <input id="name" class="form-control" name="name" placeholder="Enter Name" type="text">
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                        </div>
                    </div>

                    <div class="col-md-6" >
                    <div class="form-group">
                            <label class="form-label">Email<span class="required">*</span></label>
                                <input id="email" class="form-control" name="email" placeholder="Enter Email" type="text" >
                                <span class="text-danger">{{ $errors->first('email') }}</span> 
                        </div>
                    </div>                    
                    </div>                     
               
                <div class="row">
                <div class="col-md-6" >
                    <div class="form-group">
                            <label class="form-label">Password<span class="required">*</span></label>
                                <input id="password" class="form-control" name="password" type="password">    
                   </div>
                    </div> 
                <div class="col-md-6" >
                    <div class="form-group">
                            <label class="form-label">Profile<span class="required">*</span></label>
                                <input id="profile" class="form-control" name="profile" type="file">    
                   </div>
                    </div>     
                </div>
                    <div class="modal-footer">
                    <button type="button" id="modal-create-submit" name="modal-create-submit" data-loading-text="Please wait..." class="btn btn-orange mt-ladda-btn ladda-button mt-progress-demo" data-style="expand-left" onclick="submit_data()">
                <span class="ladda-label">Submit</span>
            </button>
            <button type="button" id="CloseModalBtn" data-dismiss="modal" class="btn btn-default btn-cons">Cancel</button>
                    </div>
                  </div>
                </div>
</div>
              </div><!-- End Large Modal-->
    <table id="catTable" class="table table-bordered data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Category Name</th>
                <th>Status</th>               
                <th>Action</th>
               
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
  

@endsection
@push('custom-scripts')

<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    var frmModalForm = $('#frmModalForm');
  
    var form_error = $('.alert-danger', frmModalForm);
    var form_success = $('.alert-success', frmModalForm);

   $("#frmModalForm").validate({
      rules: {
         name: 'required',
         status: 'required',
        
       
      },
      messages: {
            name: 'This field is required',    
            status: 'Enter a valid email',
        },
        success: function (label) {
            label.closest('.form-group').removeClass('has-error');
        },
         submitHandler: function (form) {
            form_success.show();
            form_error.hide();
         }
   });
});
</script>
      <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#catTable').DataTable({
                "processing": true,
                "serverSide": true,              
                "ajax" : {
                "url" : "category",
                "type" : "GET"
              
            },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
        
            });
        });


function submit_data() {
    var base_url = window.location.origin;
      if (!$('#frmModalForm').valid()) {
          return false;
      }  
          url = base_url + '/student/public/users/store';      
     
      var frmVendor = $('#frmModalForm');
      var form_data = new FormData();  
      var other_data = frmVendor.serializeArray();
      $.each(other_data,function(key,input){
          form_data.append(input.name,input.value);
      });
     
    form_data.append('profile', $('input[type=file]')[0].files[0]); 
    $.ajax({
          type: "POST",
          url: url,
          data: form_data,
          processData: false,
          contentType: false,
         
          success: function (Odata) {
            
              var Data = JSON.parse(Odata);
              if (Data['success']) {
                  alert(Data['Msg'], 'success');  
                  $('#CloseModalBtn').click();        
                 // datatable_refresh();
              } else {
                  $('#modalerrordiv').show();
                  $('#modalerrorlog').html(Data['Msg']);
              }
              customunBlockUI();
          }, error: function (XMLHttpRequest, textStatus, errorThrown) {
              alert(textStatus,"error");
          }
      });
  }
 
      </script>
      @endpush
 