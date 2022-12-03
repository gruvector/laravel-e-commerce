<style>
    .slide {
        border: 1px solid #e9e9e9;
        border-radius: 3px;
        margin-bottom: 15px;
    }

    .slide .slide-header {
        padding: 15px;
        background: #f6f6f7;
        border-bottom: 1px solid #e9e9e9;
    }

    .slide .slide-header span {
        font-size: 16px;
    }

    .slide .slide-body {
        position: relative;
        padding: 15px;
    }

    .product-downloads-wrapper .slide {
        margin-bottom: 20px;
    }

    .product-downloads-wrapper .table > tbody > tr > td {
        vertical-align: middle;
    }

    .product-downloads-wrapper .options .drag-icon {
        margin-top: 3px;
    }

    .product-downloads-wrapper .choose-file-group {
        display: flex;
    }

    .product-downloads-wrapper .download-name {
        flex-grow: 1;
    }

    .product-downloads-wrapper .btn-choose-file {
        margin-left: 8px;
    }

    @media screen and (max-width: 767px) {
        .product-downloads-wrapper .table > tbody > tr {
            border-top: 1px solid #e9e9e9;
        }

        .product-downloads-wrapper .table > tbody > tr > td:nth-child(2),
        .product-downloads-wrapper .table > tbody > tr > td:nth-child(3) {
            display: block;
            border: none;
            width: auto;
            padding-left: 15px;
            padding-right: 15px;
            text-align: left;
            vertical-align: initial;
        }

        .product-downloads-wrapper .table > tbody > tr > td:nth-child(3) {
            padding-bottom: 15px;
        }

        .product-downloads-wrapper .options .drag-icon {
            margin-top: 0;
        }
    }
</style>

<div id="product-downloads-wrapper" class="product-downloads-wrapper clearfix">
    <div class="slide">
        <div class="slide-header clearfix">
            <span class="pull-left">
                {{ trans('product::products.form.downloadable_files') }}
            </span>
        </div>

        <div class="slide-body">
            <div class="table-responsive">
                <table class="options table table-bordered">
                    <thead class="hidden-xs">
                        <tr>
                            <th></th>
                            <th>{{ trans('product::products.form.file') }}</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody id="downloads-wrapper">
                        {{-- Downloadable file will be added here dynamically using JS --}}
                    </tbody>
                </table>
            </div>

            <button type="button" class="btn btn-default" id="add-new-file">
                {{ trans('product::products.form.add_new_file') }}
            </button>
        </div>
    </div>
</div>

@include('product::admin.products.tabs.templates.download')

@push('globals')
    <script>
        FleetCart.data['product.downloads'] = {!! old_json('downloads', $product->downloads ?? []) !!};
    </script>
@endpush
