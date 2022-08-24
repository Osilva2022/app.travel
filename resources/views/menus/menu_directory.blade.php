<div class="row mb-4">
    <div class="col">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">#</a>
            </li>
            @foreach ($alphachar as $key)
                <li class="nav-item">
                    <a href="{{ route('guide_category', ["$destination", "$category"]) }}?letter={{ $key->letter }}"
                        class="nav-link {{ $key->letter === $selectedtletter ? 'active' : '' }} nav-letter"
                        data-letter="{{ $key->letter }}" href="#">{!! $key->letter !!}</a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
