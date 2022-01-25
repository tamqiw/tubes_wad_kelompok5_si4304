@extends('template')

@section('page-heading')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Ruangan</h3>
                    <p class="text-subtitle text-muted">Edit Ruangan {{$data->name}}</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Ruangan</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-content')
    <section class="section">
        @include('components.message')
    </section>


    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Data Ruangan {{$data->name}}</h4>
            </div>

            <div class="card-body">
                <form action='{{ url("room/$data->id/update") }}' enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="basicInput">Nama Ruangan</label>
                                <input type="text" name="name" required class="form-control"
                                       value="{{ old('name',$data->name) }}"
                                       placeholder="Nama Ruangan">
                            </div>


                            <div class="form-group">
                                <label for="basicInput">Harga Ruangan</label>
                                <input type="text" name="price" required class="form-control"
                                       value="{{ old('price',$data->price) }}"
                                       placeholder="Harga per Ruangan">
                            </div>

                            <div class="form-group">
                                <label for="">Deskripsi Ruangan</label>
                                <textarea class="form-control" name="mcontent" id="summernote" rows="10"
                                          placeholder="Konten Berita">{{old('mcontent',$data->desc)}}</textarea>
                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="basicInput">Kapasitas Ruangan</label>
                                <input type="text" name="cap" required class="form-control"
                                       value="{{ old('cap',$data->capacity) }}"
                                       placeholder="Kapasitas Ruangan">
                            </div>


                            <div class="form-group">
                                <label for="formFile" class="form-label">Foto Ruangan ( Multiple )</label>
                                <input name="photos[]" accept="image/*" multiple class="form-control" type="file"
                                       id="formFile">
                            </div>

                            <div class="form-group">
                                <label for="">Kategori/Jenis Ruangan</label>
                                <select class="form-control form-select" name="category">
                                    @forelse($roomtypes as $cats)
                                        <option value="{{$cats->id}}">{{$cats->name}}</option>
                                    @empty

                                    @endforelse
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="">Fasilitas </label> <br>
                                @forelse($facilities as $fats)
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            <input
                                                @if(in_array($fats->id, $facilitiesarray))
                                                checked="checked" checked
                                                @endif
                                                class="form-check-input" type="checkbox" name="facilities[]"
                                                value="{{$fats->id}}"> {{$fats->name}}
                                        </label>
                                    </div>
                                @empty

                                @endforelse
                            </div>

                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Add Data</button>
                        </div>
                    </div>

                </form>

            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Foto Ruangan {{$data->name}}</h4>
            </div>

            <div class="card-body">
                <form action="{{ url('room-photos/store') }}" enctype="multipart/form-data" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{$data->id}}">

                    <div style="border: black; border-radius: 20px" class="row">
                        <h5>Tambah Foto Baru</h5>

                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="formFile" class="form-label">Foto Ruangan</label>
                                <input name="photo" accept="image/*" class="form-control" type="file"
                                       id="formFile">
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Tambah Ruangan</button>
                    </div>
                </form>

                <div class="row">
                    <div
                        class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                        <div class="dataTable-container">
                            <table class="table table-striped dataTable-table" id="table_data">
                                <thead>
                                <tr>
                                    <th data-sortable="">No</th>
                                    <th data-sortable="">Foto</th>
                                    <th data-sortable="">Diinput Pada</th>
                                    <th data-sortable="">Hapus</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse ($photos as $pot)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <img height="200px" style="border-radius: 20px"
                                                 src='{{asset("$pot->path")}}' alt="">
                                        </td>
                                        <td>{{ $pot->created_at }}</td>
                                        <td>
                                            <a href="{{url("room-photos/$pot->id/delete")}}">
                                                <button id="{{ $pot->id }}" data-toggle="modal" type="button"
                                                        class="btn btn-danger btn-delete">Delete Data
                                                </button>
                                            </a>
                                        </td>
                                    </tr>
                                @empty

                                @endforelse

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </section>

@endsection

@push('page-style')
    <link rel="stylesheet" href="{{ asset('/frontend') }}/assets/vendors/summernote/summernote-lite.min.css">

@endpush

@push('script')
    <script src="{{ asset('/frontend') }}/assets/vendors/jquery/jquery.min.js"></script>
    <script src="{{ asset('/frontend') }}/assets/vendors/summernote/summernote-lite.min.js"></script>

    <script>
        $('#summernote').summernote({
            tabsize: 2,
            height: 120,
        })
        $("#hint").summernote({
            height: 100,
            toolbar: false,
            placeholder: 'type with apple, orange, watermelon and lemon',
            hint: {
                words: ['apple', 'orange', 'watermelon', 'lemon'],
                match: /\b(\w{1,})$/,
                search: function (keyword, callback) {
                    callback($.grep(this.words, function (item) {
                        return item.indexOf(keyword) === 0;
                    }));
                }
            }
        });
    </script>
    <script>
        var el = document.getElementById('formFile');
        el.onchange = function () {
            var fileReader = new FileReader();
            fileReader.readAsDataURL(document.getElementById("formFile").files[0])
            fileReader.onload = function (oFREvent) {
                document.getElementById("imgPreview").src = oFREvent.target.result;
            };
        }


        $(document).ready(function () {
            $.myfunction = function () {
                $("#previewName").text($("#inputTitle").val());
                var title = $.trim($("#inputTitle").val())
                if (title == "") {
                    $("#previewName").text("Judul")
                }
            };

            $("#inputTitle").keyup(function () {
                $.myfunction();
            });

        });
    </script>
@endpush
