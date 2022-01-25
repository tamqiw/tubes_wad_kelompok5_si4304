@extends('template')

@section('page-heading')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Edit Fasilitas</h3>
                    <p class="text-subtitle text-muted">Edit Fasilitas</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('material/manage') }}">Fasilitas</a></li>
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
                <h4 class="card-title">Edit Jenis Ruangan</h4>
            </div>

            <div class="card-body">
                <form action='{{ url("facility/$data->id/update") }}' enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-12 mb-5">
                            <img src="{{asset($data->photo)}}" style="border-radius: 20px" id="imgPreview"
                                 class="img-fluid" alt="Responsive image">
                            <h5 class="mt-3">Nama Fasilitas : {{$data->name}}</h5>
                        </div>

                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="basicInput">Nama Fasilitas</label>
                                <input type="text" name="name" required class="form-control"
                                       value="{{ old('name',$data->name) }}"
                                       placeholder="Nama Fasilitas">
                            </div>

                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="formFile" class="form-label">Ganti Foto</label>
                                <input name="photo" class="form-control" type="file" id="formFile">
                            </div>

                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Deskripsi</label>
                                <textarea class="form-control" style="height: 300px !important;" name="mcontent" id="summernote" rows="10"
                                          placeholder="Deskripsi Ruangan">{{old('mcontent',$data->content)}}</textarea>
                            </div>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Edit Data</button>
                        </div>
                    </div>

                </form>

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
            height: 500,
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
