@if (session()->has('success'))
    <div class="alert alert-success fade in alert-dismissable clearfix">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

        <div class="alert-icon">
            <i class="fa fa-check" aria-hidden="true"></i>
        </div>

        <span class="alert-text">{{ session('success') }}</span>
    </div>
@endif

@if (session()->has('error'))
    <div class="alert alert-danger fade in alert-dismissable clearfix">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

        <div class="alert-icon">
            <i class="fa fa-exclamation" aria-hidden="true"></i>
        </div>

        <span class="alert-text">{{ session('error') }}</span>
    </div>
@endif
