@extends('template_horizontal')

@section('content')

    <div class="container">
        <section class="section">
            @include('components.message')
        </section>
    </div>

    <div class="container">

        <div class="row">
            <h4 class="card-title">Booking Ruangan</h4>
            <hr>

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
                            <h5>Rp.{{$data->price}} / malam</h5>

                            <a href='{{url("/room/$data->id/booking")}}'>
                                <button class="btn btn-primary block mt-3">Booking Ruangan</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <section class="section col-xl-8 col-sm-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Pesan Ruangan {{$data->name}}</h4>
                    </div>

                    <div class="card-body">
                        <form action="{{ url('booking/store') }}" enctype="multipart/form-data" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="basicInput">Nama Pemesan</label>
                                        <input type="text" name="booker_name" required class="form-control"
                                               value="{{ old('name',Auth::user()->name) }}"
                                               placeholder="Nama Pemesan">
                                    </div>

                                    <div class="form-group">
                                        <label for="basicInput">Tanggal Checkin</label>
                                        <input type="datetime-local" name="start_date" required class="form-control"
                                               value="{{ old('name',Auth::user()->name) }}"
                                               placeholder="Nama Pemesan">
                                    </div>

                                    <div class="form-group">
                                        <label for="basicInput">Tanggal Check-out</label>
                                        <input type="datetime-local" name="end_date" required class="form-control"
                                               value="{{ old('name',Auth::user()->name) }}"
                                               placeholder="Nama Pemesan">
                                    </div>

                                    <div class="form-group">
                                        <label for="">Catatan / Permintaan Khusus</label>
                                        <textarea class="form-control" name="booker_request" id="summernote" rows="4"
                                                  placeholder="Catatan Khusus">{{old('booker_request')}}</textarea>
                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="basicInput">Kontak Pemesan</label>
                                        <input type="text" name="booker_contact" required class="form-control"
                                               value="{{ old('booker_contact',Auth::user()->contact) }}"
                                               placeholder="Kontak Pemesan">
                                    </div>

                                    <div class="form-group">
                                        <label for="formFile" class="form-label">Bukti Bayar</label>
                                        <input name="photo" class="form-control" type="file" id="formFile">
                                    </div>

                                    <img src="https://i.stack.imgur.com/y9DpT.jpg" style="border-radius: 20px"
                                         id="imgPreview"
                                         class="img-fluid" alt="Responsive image">
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Add Data</button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </section>

        </div>
    </div>

    <div class="container">
        <div class="card mt-5">
            <div class="card-header">
                <h4 class="card-title">Foto Ruangan {{$data->name}}</h4>
            </div>
            <div class="row">

                @forelse ($data->all_photo as $fot)
                    <div class=" col-xl-4 col-sm-4">

                        <div class="card">
                            <div class="card-content mx-2">
                                <img class="card-img-top img-fluid"
                                     src="{{asset($fot->path)}}"
                                     alt="Card image cap" style="height: 15rem;
                                 margin-top: 10px;
                                 border-radius: 20px">
                            </div>
                        </div>
                    </div>

                @empty

                @endforelse

            </div>

        </div>
    </div>
@endsection
