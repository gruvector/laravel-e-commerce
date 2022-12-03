<div class="accordion-content clearfix">
    <div class="col-lg-3 col-md-4">
        <div class="accordion-box">
            <div class="panel-group" id="{{ $name }}">
                @foreach ($groups as $group => $options)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a
                                    @if (count($groups) > 1)
                                        class="{{ ($options['active'] ?? false) ? '' : 'collapsed' }} {{ $tabs->group($group)->hasError() ? 'has-error' : '' }}"
                                        data-toggle="collapse"
                                        data-parent="#{{ $name }}"
                                        href="#{{ $group }}"
                                    @endif
                                >
                                    {{ $options['title'] }}
                                </a>
                            </h4>
                        </div>

                        <div id="{{ $group }}" class="panel-collapse collapse {{ ($options['active'] ?? false) ? 'in' : '' }}">
                            <div class="panel-body">
                                <ul class="accordion-tab nav nav-tabs">
                                    {{ $tabs->group($group)->navs() }}
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="col-lg-9 col-md-8">
        <div class="accordion-box-content">
            <div class="tab-content clearfix">
                {{ $contents }}

                @include('admin::form.footer')
            </div>
        </div>
    </div>
</div>
