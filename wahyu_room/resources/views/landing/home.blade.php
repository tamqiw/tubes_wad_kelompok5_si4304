@extends('landing.template')

@section('main')
    <!-- ---------- SECTION 1 ---------- -->

    <section class="section-1">
        <div class="section-title">
            <div class="border-section-left"></div>
            <h2>Fasilitas Kami</h2>
            <div class="border-section-right"></div>
        </div>

        <div class="advice-cards" style="padding: 10px!important;">
            @forelse ($facilities as $data)
                <div>
                    <img  src="{{asset($data->photo)}}" alt="icone 1"/>
                    <p>{{$data->name}}</p>
                </div>
            @empty

            @endforelse

        </div>
    </section>


    <section class="section-2">
        <div class="container">
            <div class="section-title">
                <div class="border-section-left"></div>
                <h2>Kamar Kami</h2>
                <div class="border-section-right"></div>
            </div>


            <div class="carrousel">
                <div>
                    <h3>Ruangan kami</h3>
                    <p class="description">
                        Ruangan diskusi nyaman untuk meeting harian anda.
                    </p>
                    
                </div>
                @forelse ($rooms as $item)

                    <div>
                        <div class="carrousel-images">
                            <img src='{{asset($item->cover)}}' alt="Arc de Triomphe"/>
                            <div class="favorite"></div>

                        </div>
                        <h4>{{$item->name}}</h4>
                        <div class="carrousel-reviews">
                            <i class="icon-bubble_rating_full_refresh"></i>
                            <i class="icon-bubble_rating_full_refresh"></i>
                            <i class="icon-bubble_rating_full_refresh"></i>
                            <i class="icon-bubble_rating_full_refresh"></i>
                            <i class="icon-bubble_rating_full_refresh"></i>
                            <p>Rp.{{$data->price}}</p>
                        </div>
                        <p class="item-description">
                           {!! $data->desc !!}
                        </p>
                    </div>

                @empty

                @endforelse

            </div>

        </div>
    </section>


@endsection
