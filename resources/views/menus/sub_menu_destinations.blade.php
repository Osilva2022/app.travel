<div class="row mb-4">
    <div class="col">
        <div class="cont-menu-destination" style="overflow-x: auto; height: 60px;">
            <ul class="nav nav-tabs justify-content-end" id="myTab" role="tablist" style="min-width: 550px;">
                <li class="nav-item nav-test mx-1" role="presentation">
                    <a class="nav-link" id="all-tab" href="{{ url("$category") }}"
                        type="button"><small>All</small></a>
                </li>
                @foreach ($destinations_data as $data)
                    <?php $active = ''; ?>
                    <?php $selected = 'false'; ?>
                    {{-- @if ($data->name == 'Puerto Vallarta')
                                    <?php $active = 'active'; ?>
                                    <?php $selected = 'true'; ?>
                                @endif --}}
                    <li class="nav-item nav-test mx-1" role="presentation">
                        <a class="nav-link" id="{{ $data->slug }}-tab"
                            href="{{ url("$category") }}?destination={{ $data->slug }}" type="button">
                            <small>{{ $data->name }}</small></a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
