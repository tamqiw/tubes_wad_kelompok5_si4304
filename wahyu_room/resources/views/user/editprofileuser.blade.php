@extends('template_horizontal')

@section('content')

    <div class="container">
        <section class="section">
            @include('components.message')
        </section>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Data</h4>
                    </div>

                    <div class="card-body">
                        <form action="{{ url('user/update') }}" method="post">
                            <input type="hidden" name="id" value="{{$users->id}}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="basicInput">Nama User</label>
                                        <input type="text" name="user_name" required class="form-control"
                                               value="{{ old('user_name', $users->name) }}" required id="basicInput"
                                               placeholder="Nama Lengkap User">
                                    </div>

                                    <div class="form-group">
                                        <label for="basicInput">Email</label>
                                        <input type="email" name="user_email" required class="form-control"
                                               value="{{ old('user_email', $users->email) }}" id=" basicInput"
                                               placeholder="Email User">
                                    </div>

                                    <div class="form-group">
                                        <label for="basicInput">Kontak User</label>
                                        <input type="text" name="user_contact" class="form-control"
                                               value="{{ old('user_contact', $users->contact) }}" placeholder="Kontak User">
                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="basicInput">Password</label>
                                        <input type="password" name="user_password" class="form-control" id="basicInput"
                                               placeholder="Password">
                                        <small class="form-text text-muted">Isi Jika Ingin Mereset Password User</small>
                                    </div>

                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="destroy-modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title white" id="myModalLabel120">
                        Apakah Anda Yakin ingin menghapus data ini ?
                    </h5>
                    <button type="button" class="close hide-modal" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Aksi Ini Tidak Dapat Dibatalkan
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary hide-modal" data-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class=" d-sm-block">Close</span>
                    </button>

                    <a class="btn-destroy" href="">
                        <button type="button" class="btn btn-danger ml-1 hide-modal " data-dismiss="modal">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class=" d-sm-block">Delete</span>
                        </button>
                    </a>

                </div>
            </div>
        </div>
    </div>



@endsection

@push('script')
    <script type="text/javascript"
            src="https://cdn.datatables.net/v/bs4-4.1.1/jszip-2.5.0/dt-1.10.23/b-1.6.5/b-colvis-1.6.5/b-flash-1.6.5/b-html5-1.6.5/b-print-1.6.5/cr-1.5.3/r-2.2.7/sb-1.0.1/sp-1.2.2/datatables.min.js">
    </script>
    <script type="text/javascript" charset="utf8"
            src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js">
    </script>
    <script type="text/javascript" charset="utf8"
            src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js">
    </script>
    <script type="text/javascript" charset="utf8"
            src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js">
    </script>

    <script type="text/javascript">
        $(function () {
            var table = $('#table_data').DataTable({
                processing: true,
                serverSide: false,
                columnDefs: [{
                    orderable: true,
                    targets: 0
                }],
                dom: 'T<"clear">lfrtip<"bottom"B>',
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                buttons: [
                    'copyHtml5',
                    {
                        extend: 'excelHtml5',
                        title: 'Data Export {{ \Carbon\Carbon::now()->year }}'
                    },
                    'csvHtml5',
                ],
            });


        });

        $('body').on("click", ".btn-delete", function () {
            var id = $(this).attr("id")
            $(".btn-destroy").attr("href", window.location.origin + "/booking/" + id + "/delete")
            $("#destroy-modal").modal("show")
        });
    </script>


@endpush

