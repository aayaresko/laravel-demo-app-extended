<a class="dropdown-toggle text-uppercase" aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" href="#">
    {{ $current }}
</a>
<ul class="dropdown-menu minimal">
    @foreach($items as $locale)
        <li>
            <a class="text-uppercase" href="{{ $locale->get('url') }}">{{ $locale->get('label') }}</a>
        </li>
    @endforeach
</ul>