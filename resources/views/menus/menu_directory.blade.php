<div class="row mb-4">
    <div class="col">
        <ul class="nav nav-tabs">
            @foreach ($alphachar as $key)
                <li class="nav-item">
                    <a href="{{ route('guide_category', ["$destination", "$category"]) }}?letter={!! $key->letter !!}"
                        class="nav-link {{ $key->letter === $selectedtletter ? 'active' : '' }} nav-letter"
                        data-letter="{{ $key->letter }}"
                        href="#">{{ $key->letter == '*' ? '#' : $key->letter }}</a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
