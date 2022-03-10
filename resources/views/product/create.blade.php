@extends('layout.admin')
@section('content')
<div class="pagetitle">
      <h1>Form Layouts</h1>
     
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
            @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                    </div>
                    <br>
                    @endif
              <h5 class="card-title">Create User</h5>

              <!-- Horizontal Form -->
              <form id="frmModalForm" name="frmModalForm" onsubmit="return false;" enctype="multipart-data">
              @csrf
                <div class="row mb-3">
                 
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Your Name</label>
                  <div class="col-sm-10">
                  <input id="name" class="form-control" name="name" placeholder="Enter Name" type="text">
                  <span class="text-danger">{{ $errors->first('name') }}</span>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                  <div class="col-sm-10">
                  <input id="email" class="form-control" name="email" placeholder="Enter Email" type="text" >
                                <span class="text-danger">{{ $errors->first('email') }}</span> 
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                  <div class="col-sm-10">
                  <input id="password" class="form-control" name="password" type="password">    
                  </div>
                </div>

                <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Roles</label>
                  <div class="col-sm-10">
                  <select id="role" name="role" class="form-select">
                    <option>Choose Role</option>
                    @foreach($roles as $role)
                    <option value="{{ $role->arid }}">{{ $role->rolename }}</option>
                    @endforeach
                   
                  </select>


                </div>
                </div>
                <div class="row mb-3">
                  <label for="inputPassword3" class="col-sm-2 col-form-label">Profile</label>
                  <div class="col-sm-10">
                  <input id="profile" class="form-control" name="profile" type="file">  
                  </div>
                </div>
             
              
                <div class="text-center">
                 
            <button type="button" id="modal-create-submit" name="modal-create-submit" data-loading-text="Please wait..." class="btn btn-primary" data-style="expand-left" onclick="submit_data()">
                Submit
            </button>
            <button type="button" id="CloseModalBtn" data-dismiss="modal" class="btn btn-secondary">Cancel</button>
                </div>
              </form><!-- End Horizontal Form -->

            </div>
          </div>

        

        </div>

        
      </div>
    </section>
@endsection

@push('custom-scripts')


<script type="text/javascript">
$(document).ready(function() {
    var frmModalForm = $('#frmModalForm');
  
    var form_error = $('.alert-danger', frmModalForm);
    var form_success = $('.alert-success', frmModalForm);

   $("#frmModalForm").validate({
      rules: {
         name: 'required',
         
        email: {
            required: true,
            email: true,//add an email rule that will ensure the value entered is valid email id.
            maxlength: 255,
         },
      },
      messages: {
            name: 'This field is required',           
            email: 'Enter a valid email',
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
                  window.location.href = window.location.origin+'/student/public/users';   
                 
                 // datatable_refresh();
              } else {
                  $('#modalerrordiv').show();
                  $('#modalerrorlog').html(Data['Msg']);
              }            
          }, error: function (XMLHttpRequest, textStatus, errorThrown) {
              alert(textStatus,"error");
          }
      });
  }

  function datatable_refresh() {
        var table = $('#index_table');
        table.dataTable({
            destroy: true,
            "language": {
                "aria": {
                    "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                },
                "emptyTable": "No data available in table",
                "info": "Showing _START_ to _END_ of _TOTAL_ records",
                "infoEmpty": "No records found",
                "infoFiltered": "(filtered1 from _MAX_ total records)",
                "lengthMenu": "Show _MENU_",
                "search": "Search:",
                "zeroRecords": "No matching records found",
                "paginate": {
                    "previous": "Prev",
                    "next": "Next",
                    "last": "Last",
                    "first": "First"
                }
            },
            "bStateSave": false,
            "lengthMenu": [
                [5, 10, 15, 20, -1],
                [5, 10, 15, 20, "All"]
            ],
            "pageLength": 10,
            "pagingType": "bootstrap_full_number",
            "columnDefs": [
                {'width': '30px', 'orderable': false, 'searchable': false, 'targets': [0]},
                {'width': '40px', 'orderable': true, 'searchable': true, 'targets': [1]},
                {'width': '200px', 'orderable': true, 'searchable': true, 'targets': [2]},
                {'width': '', 'orderable': false, 'searchable': false, 'targets': [3]},
                {'width': '60px', 'orderable': false, 'searchable': false, 'targets': [4]},
                {'width': '70px', 'orderable': false, 'searchable': false, 'targets': [5]}
            ],
            "order": [
                [1, "desc"]
            ],
            "processing": true,
            "serverSide": true,
            "sAjaxSource":  window.location.origin+ 'myfeed/datatable_refresh',
            "fnServerData": function (sSource, aoData, fnCallback) {
                aoData.push({name: '__mode', value: 'featuredimage.ajaxload'});
                $.getJSON(sSource, aoData, function (json) {
                    fnCallback(json);
                });
            },
            "fnRowCallback": function (nRow, aData, iDisplayIndex) {
                return nRow;
            }
            , "fnFooterCallback": function (nRow, aData) {
            }
        });
    }
</script>
@endpush