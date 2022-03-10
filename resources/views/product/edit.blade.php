@extends('layout.admin')
@section('content')


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
              <h5 class="card-title">Create Role</h5>

              <!-- Horizontal Form -->
              <form id="frmRole" name="frmRole" method="POST"  action="{{ route('roles.update',$role->arid) }}">            
              @csrf
              @method('patch')
              <div class="row">
                <div class="col-md-6">
                  <label for="inputEmail5" class="form-label">Role Name</label>
                  <input type="text" class="form-control" id="rolename" name="rolename" placeholder="Enter Role Name" value="{{ $role->rolename}}">
                  <span class="text-danger">{{ $errors->first('rolename') }}</span>
                </div>
                <div class="col-md-6">
                  <label for="inputPassword5" class="form-label">Status</label>
                  <select name="status" class="form-select" id="status">
                    <option>Select Status</option>            
                  
                    <option value="1" {{($role->status == 1) ? 'selected': '';}}>Active</option>
                    <option value="0" {{($role->status == 0) ? 'selected': '';}}>InActive</option>
                 
                  </select>
                </div>
                </div>
                <div class="col-md-6">
                  <label for="inputState" class="form-label">Remark</label>
                  <textarea name="description" class="form-control" >{{ ($role->description) ? $role->description : ''; }}</textarea>
                </div>
               <br/>
                <div class="row">
                <table class="table table-bordered table-hover table-checkable order-column" id="role_table">
                                            <thead>
                                                <tr>
                                                    <th>Sr. No.</th>
                                                    <th>Module Name</th>
                                                    <th>Full Access</th>
                                                    <th>View</th>
                                                    <th>Add</th>
                                                    <th>Edit</th>
                                                    <th>Delete</th>
                                                    <th>Print</th>
                                                    <th>Import</th>
                                                    <th>Export</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                          <?php  $srNo = 0; ?>
                                          @foreach($modules as $key=>$module) 
                                          <?php   $srNo++;    ?>                                                     
                                         
                                            <tr class="">
                                                        <td> {{ $srNo }}</td>
                                                        <td>{{ $module['modulename'] }}</td>
                                                        <td class="td-full-access">
                                                            <label class="mt-checkbox mt-checkbox-outline" for="users">
                                                                <input type="checkbox" class="checkRole" onclick="role_checkall('{{$module->modulename}}')" value="1" id="{{$module->modulename}}">
                                                                <span></span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <label class="mt-checkbox mt-checkbox-outline" for="chk_view{{$key}}">
                                                                <input type="checkbox" class="checkRole" name="{{$module->modulename}}_own[]" value="2" id="chk_view{{$key}}" {{($module->allow_view == 1) ? 'checked' : ''}}>
                                                                <span></span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <label class="mt-checkbox mt-checkbox-outline" for="chk_add{{$key}}">
                                                                <input type="checkbox" class="checkRole" name="{{$module->modulename}}_own[]" value="3" id="chk_add{{$key}}" {{($module->allow_add == 1) ? 'checked' : ''}}>
                                                                <span></span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <label class="mt-checkbox mt-checkbox-outline" for="chk_edit{{$key}}">
                                                                <input type="checkbox" class="checkRole" name="{{$module->modulename}}_own[]" value="4" id="chk_edit{{$key}}" {{($module->allow_edit == 1) ? 'checked' : ''}}>
                                                                <span></span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <label class="mt-checkbox mt-checkbox-outline" for="chk_del{{$key}}">
                                                                <input type="checkbox" class="checkRole" name="{{$module->modulename}}_own[]" value="5" id="chk_del{{$key}}" {{($module->allow_delete == 1) ? 'checked' : ''}}>
                                                                <span></span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <label class="mt-checkbox mt-checkbox-outline" for="chk_print{{$key}}">
                                                                <input type="checkbox" class="checkRole" name="{{$module->modulename}}_own[]" value="6" id="chk_print{{$key}}" {{($module->allow_print == 1) ? 'checked' : ''}}>
                                                                <span></span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <label class="mt-checkbox mt-checkbox-outline" for="chk_import{{$key}}">
                                                                <input type="checkbox" class="checkRole" name="{{$module->modulename}}_own[]" value="7" id="chk_import{{$key}}" {{($module->allow_import == 1) ? 'checked' : ''}}>
                                                                <span></span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <label class="mt-checkbox mt-checkbox-outline" for="chk_export{{$key}}">
                                                                <input type="checkbox" class="checkRole" name="{{$module->modulename}}_own[]" value="8" id="chk_export{{$key}}" {{($module->allow_export == 1) ? 'checked' : ''}}>
                                                                <span></span>
                                                            </label>
                                                        </td>
                                                    </tr>

  @endforeach       
                                                        
                                                    </tbody>
                                        </table>
                </div>
                <div class="text-center">
                 
                <button type="submit" id="role-submit" name="role-submit" data-loading-text="Please wait..." class="btn btn-orange mt-ladda-btn ladda-button mt-progress-demo" data-style="expand-left">
                                                <span class="ladda-label">Submit</span>
                                            </button>
                                            <a href="{{ url('/') }}" class="btn btn-default btn-cons">Cancel</a>
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
   function role_checkall(module)
    {
        if ($('#' + module).prop("checked") == true) {
            $("input[name='" + module + "_own[]']").prop('checked', true);
        } else {
            $("input[name='" + module + "_own[]']").prop('checked', false);
        }
    }
$(document).ready(function() {

});
</script>
@endpush