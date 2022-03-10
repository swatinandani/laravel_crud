<?php echo (isset($Error) && $Error != '' ? $Error :'');?>
<!--Custom Errors div.-->
<div id="errordiv" class="alert alert-danger display-hide">
    <button class="close" data-close="alert"></button>
    You have some form errors. Please check below.
    <br><span id="errorlog"></span>
</div>

<!--Flash Messages-->
@if(session('success'))

    <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
        <h4>{{session('success')}}</h4>
    </div>
@endif