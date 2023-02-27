<div class="row mb-4">
    <div class="col">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <span style="cursor: pointer;"
                        wire:click="buscar_nombre('*')"
                    class="nav-link {{ '' === $selectedtletter ? 'active' : '' }} nav-letter"
                    data-letter="">All</span>
            </li>
            @foreach ($alphachar as $key)
                <li class="nav-item">
                    <span style="cursor: pointer;"
                        wire:click="buscar_nombre('{{ $key->letter_n }}')"
                        class="nav-link {{ $key->letter_n === $selectedtletter ? 'active' : '' }} nav-letter"
                        >{{ $key->letter_n == '*' ? '#' : $key->letter_n }}</span>
                </li>
            @endforeach
        </ul>
    </div>
</div>
