<nav class="navbar navbar-static-top clearfix">
    <ul class="nav navbar-nav clearfix">
        <li class="visit-store hidden-sm hidden-xs">
            <a href="{{ route('home') }}">
                <i class="fa fa-desktop"></i>
                {{ trans('admin::admin.visit_store') }}
            </a>
        </li>

        <li class="dropdown top-nav-menu pull-right">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-user-circle-o"></i><span>{{ $currentUser->first_name }}</span>
            </a>

            <ul class="dropdown-menu">
                <li><a href="{{ route('admin.profile.edit') }}">{{ trans('user::users.profile') }}</a></li>
                <li><a href="{{ route('admin.logout') }}">{{ trans('user::auth.logout') }}</a></li>
            </ul>
        </li>

        @if (count(supported_locales()) > 1)
            <li class="language dropdown top-nav-menu pull-right">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <span>{{ strtoupper(locale()) }}</span>
                </a>

                <ul class="dropdown-menu">
                    @foreach (supported_locales() as $locale => $language)
                        <li class="{{ $locale === locale() ? 'active' : '' }}">
                            <a href="{{ localized_url($locale) }}">{{ $language['name'] }}</a>
                        </li>
                    @endforeach
                </ul>
            </li>
        @endif
    </ul>
</nav>
