@extends('admin::layout')

@component('admin::components.page.header')
    @slot('title', trans('import::importer.importer'))

    <li class="active">{{ trans('import::importer.importer') }}</li>
@endcomponent

@section('content')
	<div class="row">
        <div class="btn-group pull-right">
            <a href="#" class="btn btn-primary btn-actions">
                {{ trans('import::importer.download_csv') }}
            </a>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.importer.store') }}" enctype="multipart/form-data" class="form-horizontal">
        @csrf

    	<div class="accordion-content">
    		<div class="accordion-box-content clearfix">
    			<div class="col-md-12">
    				<div class="accordion-box-content">
    					<div class="tab-content clearfix">
    						<div class="tab-pane fade in active">
    							<h3 class="tab-content-title">
                                    {{ trans('import::importer.import') }}
                                </h3>

    							<div class="row">
    							    <div class="col-lg-6 col-md-12">
                                        {{ Form::file('csv_file', trans('import::attributes.csv_file'), $errors, null, ['required' => true]) }}
                                        {{ Form::select('import_type', trans('import::attributes.import_type'), $errors, trans('import::importer.import_types'), null, ['required' => true]) }}

		    							<div class="form-group">
		    							    <div class="col-md-offset-3 col-md-10">
		    							        <button type="submit" class="btn btn-primary" data-loading>
		    							            {{ trans('import::importer.run') }}
		    							        </button>
		    							    </div>
		    							</div>
    							    </div>
    							</div>
    						</div>
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>
    </form>
@endsection
