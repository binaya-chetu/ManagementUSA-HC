@if ($breadcrumbs)
    <ol class="breadcrumbs">
		<li>
			<a href="/">
				<i class="fa fa-home"></i>
			</a>
		</li>
        @foreach ($breadcrumbs as $breadcrumb)
            @if (!$breadcrumb->last)
                <li><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
            @else
                <li><span>{{ $breadcrumb->title }}</span></li>
            @endif
        @endforeach
    </ol>
@endif

