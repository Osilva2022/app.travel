<div class="container father">
    {{-- The Master doesn't talk, he acts. --}}
    <div class="mb-4">
        <h1 style="margin-bottom: 12px;">Daily Briefing</h1>
        <div class="fs-5 position-relative d-inline">
            <i class="bi bi-calendar position-absolute top-0 end-0 fs-6"></i>
            Today's top news - <input type="text" id="datepicker" value="{{ $date }}" readonly="readonly"
                class="position-relative bg-transparent" onchange='Livewire.emit("setDate", this.value)'>
        </div>
    </div>
    <div wire:loading.flex class="justify-content-center align-items-center" style="height:30vh;">
        <div wire:ignore class="spinner-border text-primary" role="status"
            style="margin-left: auto; margin-right: auto;">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    @if (!empty($posts))
        <div class="md:columns-2 gap-8" wire:loading.remove>
            @foreach ($posts as $item)
                @if ($item->acf->daily_presentation == 1)
                    <a href="{!! $item->link !!}" title="Read more">
                        <div class="daily-cont-1">
                            <img src="{!! $item->_embedded->{'wp:featuredmedia'}[0]->source_url !!}" alt="{!! $item->_embedded->{'wp:featuredmedia'}[0]->alt_text !!}">
                            <h2>
                                {!! $item->title->rendered !!}
                            </h2>
                            <div class="excerpt">
                                {!! $item->excerpt->rendered !!}
                            </div>
                            <a href="{!! $item->link !!}">READ MORE</a>
                        </div>
                    </a>
                @else
                    <a href="{!! $item->link !!}" title="Read more">
                        <div class="daily-cont-2">
                            <div class="d-flex align-items-center">
                                <img src="{!! $item->_embedded->{'wp:featuredmedia'}[0]->source_url !!}" alt="{!! $item->_embedded->{'wp:featuredmedia'}[0]->alt_text !!}">
                                <h2>
                                    {!! $item->title->rendered !!}
                                </h2>
                            </div>
                            <hr style="margin-top: 12px; margin-bottom: 12px;">
                            <div class="excerpt">
                                {!! $item->excerpt->rendered !!}
                            </div>
                            <a href="{!! $item->link !!}">READ MORE</a>
                        </div>
                    </a>
                @endif
            @endforeach
        </div>
    @else
        <div wire:loading.remove class="justify-content-center align-items-center" style="display:flex; height:30vh;">
            <h2 class="text-center">No results found...</h2>
        </div>
    @endif
</div>
