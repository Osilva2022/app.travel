<div class="row mb-4">
    <div class="col">
        <div class="cont-menu-destination" style="overflow-x: auto; padding-bottom: 8px;">
            <ul class="nav nav-tabs justify-content-start" id="myTab" role="tablist" style="min-width: 678px;">
                <li class="nav-item nav-test mx-1" role="presentation">
                    <a class="nav-link" id="all-tab" href="{{ url("$category") }}"
                        type="button"><small>All</small></a>
                </li>
                @foreach ($destinations_data as $data)
                    <li class="nav-item nav-test mx-1" role="presentation">
                        <a class="nav-link {{ $data->slug === $destination ? 'active' : '' }}" id="{{ $data->slug }}-tab"
                            href="{{ url("$category") }}?destination={{ $data->slug }}" type="button">
                            <small>{!! $data->name !!}</small></a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
