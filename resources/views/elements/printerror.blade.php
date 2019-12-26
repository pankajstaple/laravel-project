<div class="alert alert-danger alert-dismissible fade show request-error" role="alert" style="display:none;">
    <strong>Error!</strong> A <a href="#" class="alert-link">problem</a> has been occurred while submitting your data.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="alert alert-success alert-dismissible fade show success-message" role="alert" style="display:none;">
    <strong>Success!</strong> Data saved successfully
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="alert alert-danger alert-dismissible fade show error-message" role="alert" style="display:none;">
    <strong>Error!</strong> A <a href="#" class="alert-link">problem</a> has been occurred while submitting your data.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@if(session()->has('success'))
 <p class="alert alert-success  text-center md_top" style="width:100%">
    {{ session()->get('success') }}
    <i class="fa fa-close pull-right mar-top"></i>
 </p>
@endif
@if(session()->has('error'))
 <p class="alert alert-error alert-danger text-center md_top" style="width:100%">
    {{ session()->get('error') }}
    <i class="fa fa-close pull-right mar-top"></i>
 </p>
@endif