<div class="row mb-4">
    <div class="col">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a href="{{ route('guide_category', ["$destination", "$category"]) }}"
                    class="nav-link {{ '' === $selectedtletter ? 'active' : '' }} nav-letter"
                    data-letter=""
                    href="#">All</a>
            </li>
            @foreach ($alphachar as $key)
                <li class="nav-item">
                    <a href="{{ route('guide_category', ["$destination", "$category"]) }}?letter={!! $key->letter_n !!}"
                        class="nav-link {{ $key->letter_n === $selectedtletter ? 'active' : '' }} nav-letter"
                        data-letter="{{ $key->letter_n }}"
                        href="#">{{ $key->letter_n == '*' ? '#' : $key->letter_n }}</a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
