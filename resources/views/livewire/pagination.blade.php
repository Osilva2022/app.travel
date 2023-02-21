<div>
    @include('menus.menu_directory')
    <div class="row g-4">
        <div class="col-12 col-md-3">
            <div class="row" style="top: 7.5rem;">
                <div class="col">
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Tags Filter
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    @foreach ($guide_tags as $tag)
                                        <div class="form-check" style="font-size: 14px; font-weight: 300;">
                                            <input class="form-check-input tag-check" type="checkbox" name="tag[]"
                                                value="{!! $tag->term_id !!}" id="tag-{!! $tag->term_id !!}">
                                            <label class="form-check-label" for="tag-{!! $tag->term_id !!}">
                                                {!! $tag->name !!}
                                            </label>
                                        </div>
                                        <div class="row"></div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-12 col-md-9">
            <div class="row g-4 mb-4" id="guide-container">
                <div class="col-12" id="msg-container" style="display: none;">
                    <h1 class="text-center mt-4">No Results...</h1>
                </div>
                <?php $letra = ''; ?>
                @foreach ($things as $data)
                @include('guide.gallery')
                @endforeach

            </div>
        </div>
    </div>
</div>
