<div class="col-lg-12 containers-guide" id="container-guide-{!! $data->ID !!}">
    <div class="card-directory" id="directory-item-{!! $data->ID !!}">
        <div class="row g-2">
            {{-- VIP --}}
            @php
                $vip = false;
                if ($data->label == 21 || $data->label == 22) {
                    $vip = true;
                }
            @endphp
            @if ($vip)
                <div class="col-md-4 d-flex justify-content-center position-relative">
                    <div class="owl-carousel owl-theme directory-carousel dc" id="dc-{!! $data->ID !!}">
                        <div class="position-relative">
                            @if ($data->label == 22)
                                <span class="etiqueta-vip">
                                    <i class="bi bi-award" style="font-size: 1.5rem; color:white;"></i></span>
                            @endif
                            <img {!! img_meta($data->image_data) !!} class="card-img-estatica">
                        </div>
                        @foreach ($gallery['gallery-' . $data->ID] as $img)
                            <div class="row">
                                <div class="col">
                                    <img src="{{ images($img) }}" class="card-img-slider">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            <div class="col">
                <div class="row p-4 h-100 g-2">
                    <div class="col d-flex flex-column">
                        <h3 class="card-title mb-2">{!! $data->post_title !!}</h3>
                        <span><i class="bi bi-info-square"></i> {!! $data->post_content !!}</span>
                        <span><i class="bi bi-geo-alt"></i> {!! $data->address !!}</span>
                        @if ($vip)
                            <div id="cont-info-{!! $data->ID !!}"
                                class="cont-info collapse multi-collapse cont-info-{!! $data->ID !!}">
                                @if ($data->latitude != '' && $data->longitude != '')
                                    <span><i class="bi bi-map"></i> <a
                                            href="https://maps.google.com/?q={!! $data->latitude !!},{!! $data->longitude !!}"
                                            target="_blank">
                                            Map View</a></span>
                                @endif
                                <span><i class="bi bi-telephone"></i><a href="tel:{!! $data->phone !!}">
                                        {!! $data->phone !!}</a></span>
                                @if ($data->email)
                                    <span><i class="bi bi-envelope"></i><a href="mailto:{!! $data->email !!}">
                                            {!! $data->email !!}</a></span>
                                @endif
                                <div class="d-flex justify-content-around">
                                    @if ($data->facebook != '')
                                        <a class="m-2" target="_blank" href="{!! $data->facebook !!}">
                                            <i class="bi bi-facebook" style="font-size: 1.5rem;"></i>
                                        </a>
                                    @endif
                                    @if ($data->instagram != '')
                                        <a class="m-2" target="_blank" href="{!! $data->instagram !!}">
                                            <i class="bi bi-instagram" style="font-size: 1.5rem;"></i>
                                        </a>
                                    @endif
                                    @if ($data->whatsapp != '')
                                        <a class="m-2" target="_blank" href="https://wa.me/{!! $data->whatsapp !!}">
                                            <i class="bi bi-whatsapp" style="font-size: 1.5rem;"></i>
                                        </a>
                                    @endif
                                    @if ($data->website != '')
                                        <a class="m-2" target="_blank" href="{!! $data->website !!}">
                                            <i class="bi bi-house-door" style="font-size: 1.5rem;"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                    @if ($vip)
                        <div id="cont-info-2-{!! $data->ID !!}"
                            class="col-md-6 cont-info collapse multi-collapse cont-info-{!! $data->ID !!}">
                            <span><i class="bi bi-clock"></i> Work Hours</span>
                            @php
                                $horario = unserialize($data->avaliable);
                                $semana = [
                                    '1' => 'Monday',
                                    '2' => 'Tuesday',
                                    '3' => 'Wednesday',
                                    '4' => 'Thursday',
                                    '5' => 'Friday',
                                    '6' => 'Saturday',
                                    '7' => 'Sunday',
                                ];
                                /* var_dump($horario[1]); */
                            @endphp
                            @for ($i = 1; $i <= 7; $i++)
                                @if ($horario[$i]['off'] != 1 && $horario[$i]['hours'] != '')
                                    <span class="ps-4" style="font-size: 14px;">{!! $semana[$i] !!} -
                                        {!! $horario[$i]['hours'] !!}</span>
                                @endif
                            @endfor
                        </div>
                        <div class="col-12 cont-info collapse multi-collapse cont-info-{!! $data->ID !!}">
                            {!! $data->remark !!}
                        </div>
                        <div class="col-12 d-flex justify-content-end align-items-center">
                            <button type="button" class="btn btn-info-dir text-white" data-bs-toggle="collapse"
                                data-bs-target=".cont-info-{!! $data->ID !!}" aria-expanded="false"
                                aria-controls="cont-info-{!! $data->ID !!} cont-info-2-{!! $data->ID !!}"
                                data-id="{!! $data->ID !!}" data-status="0">
                                <i class="bi bi-plus-lg"></i> Show More
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
