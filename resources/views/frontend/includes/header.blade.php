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
                <a class="navbar-brand" href="{{ route('frontend.index') }}">@lang(config('app.name'))</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="{{ route('frontend.index') }}">@lang('content.home')</a>
                    </li>
                    <li>
                        <a href="{{ route('frontend.blog-post.index') }}">@lang('blog.title')</a>
                    </li>
                    <li>
                        <a href="{{ route('frontend.catalog-product.index') }}">@lang('catalog.title')</a>
                    </li>
                    @if (Auth::user())
                        <li>
                            <a href="{{ route('frontend.task.index') }}">@lang('task.title')</a>
                        </li>
                    @endif
                    <li>
                        <a href="{{ route('frontend.article.show', 'about-me') }}">@lang('content.author_about')</a>
                    </li>
                    <li>
                        <a href="{{ route('frontend.feedback') }}">@lang('feedback.title')</a>
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
                    @else
                        <li>
                            <a href="{{ route('auth.login') }}">@lang('auth.login')</a>
                        </li>
                        <li>
                            <a href="{{ route('frontend.account.create') }}">@lang('account.create')</a>
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