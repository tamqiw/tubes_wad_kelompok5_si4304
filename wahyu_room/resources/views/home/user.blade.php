@extends('template_horizontal')

@section('content')

    <div

    <div class="container">

        <div class="row">
            <h4 class="card-title">List Ruangan Kami</h4>
            <hr>

            <tbody>
            @forelse ($rooms as $data)
                <div class=" col-xl-4 col-sm-4">

                    <div class="card">
                        <div class="card-content mx-2">
                            <img class="card-img-top img-fluid"
                                 src="{{$data->cover}}"
                                 alt="Card image cap" style="height: 15rem;
                                 margin-top: 10px;
                                 border-radius: 20px">
                            <div class="card-body">
                                <h4 class="card-title">{{$data->category_name}}</h4>
                                <h3>{{$data->name}}</h3>
                                <p class="card-text">
                                    Kapasitas : {{$data->capacity}}
                                </p>
                                <div class="form-group">
                                    <div class="row">
                                        @forelse($facilities as $fats)
                                            <div class="form-check form-check-inline col-12">
                                                <label class="form-check-label">
                                                    @if(in_array($fats->id, explode(',', (string)$data->facilities)))
                                                        <span>
                                                        <img src="{{asset($fats->photo)}}"
                                                             width="24px" height="24px"
                                                             alt="" srcset="">
                                                        <input
                                                            checked="checked" checked disabled
                                                            class="form-check-input" type="checkbox" name="facilities[]"
                                                            value="{{$fats->id}}"> {{$fats->name}}
                                                    </span>
                                                    @endif

                                                </label>
                                            </div>
                                        @empty
                                        @endforelse
                                    </div>
                                </div>
                                <hr>
                                {!! $data->desc !!}
                                <h5>Rp{{$data->price}} / ruangan</h5>
                                <a href='{{url("/room/$data->id/booking")}}'>
                                    <button class="btn btn-primary block mt-3">Booking Ruangan</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            @empty

            @endforelse

        </div>


    </div>


    
@endsection
