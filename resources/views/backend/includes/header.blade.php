<header>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button class="navbar-toggle collapsed" aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" type="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ route('backend.index') }}">@lang(config('app.name'))</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="{{ route('backend.index') }}">@lang('content.control_panel_title')</a>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" href="#">
                            <i class="glyphicon glyphicon-list-alt"></i>
                            @lang('blog.title')
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{ route('backend.blog-post.index') }}">@choice('content.post', 2)</a>
                            </li>
                            <li>
                                <a href="{{ route('backend.blog-category.index') }}">@choice('content.category', 2)</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" href="#">
                            <i class="glyphicon glyphicon-folder-close"></i>
                            @lang('catalog.title')
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{ route('backend.catalog-product.index') }}">@choice('catalog.product', 2)</a>
                            </li>
                            <li>
                                <a href="{{ route('backend.catalog-category.index') }}">@choice('content.category', 2)</a>
                            </li>
                            <li>
                                <a href="{{ route('backend.catalog-filter.index') }}">@choice('content.filter', 2)</a>
                            </li>
                            <li>
                                <a href="{{ route('backend.catalog-filter-category.index') }}">@choice('content.filter_category', 2)</a>
                            </li>
                            <li>
                                <a href="{{ route('backend.catalog-product-property.index') }}">@choice('content.property', 2)</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ route('backend.feedback-request.index') }}">@lang('feedback.title')</a>
                    </li>
                    <li>
                        <a href="{{ route('backend.account.index') }}">@choice('account.title', 2)</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    @if (Auth::user())
                        <li>
                            <a href="{{ route('frontend.live-chat.index') }}">
                                <i class="glyphicon glyphicon-comment"></i>@lang('content.live_chat_title')
                            </a>
                        </li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" href="#">
                                <i class="glyphicon glyphicon-user"></i>
                                {{ Auth::user()->profile->full_name }}
                            </a>
                            <ul class="dropdown-menu">
                                @can('update-own-profile', Auth::user()->profile)
                                    <li>
                                        <a href="{{ route('frontend.account.edit') }}">@lang('account.profile_update')</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('frontend.subscriptions.edit') }}">@lang('subscription.update')</a>
                                    </li>
                                @endcan
                                <li>
                                    <a href="{{ route('auth.logout') }}">@lang('auth.logout')</a>
                                </li>
                            </ul>
                        </li>
                    @endif
                    <li>
                        {!! Language::renderDropdownList() !!}
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>