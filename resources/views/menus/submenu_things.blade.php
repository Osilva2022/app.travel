<div class="row mb-4">
    <div class="col">
        <div class="cont-menu-destination">
            <ul class="nav nav-tabs justify-content-start" id="myTab" role="tablist">
                <li class="nav-item nav-test mx-1" role="presentation">
                    <a class="nav-link" id="1-tab" href="{{ url('guide') }}?destination={!! $destination !!}"
                        type="button">
                        <small><i class="bi bi-arrow-left"></i> Categories</small></a>
                </li>
                <?php $n = 1; ?>
                @foreach ($things_categories as $data)
                    <?php
                    $n++;
                    $active = '';
                    if ($things_category[0]->slug == $data->category_slug) {
                        $active = 'active';
                    }
                    ?>
                    <li class="nav-item nav-test mx-1" role="presentation">
                        <a class="nav-link {{ $active }} tc-{{ $active }}" id="{!! $data->category_slug !!}-tab"
                            href="{{ route('guide_category', ["$destination", "$data->category_slug"]) }}"
                            type="button">
                            <small>{!! $data->category !!}</small></a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
