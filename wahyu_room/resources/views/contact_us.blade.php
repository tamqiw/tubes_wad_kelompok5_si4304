@extends('template_horizontal')

@section('content')
<ul class="list-group">
  <li class="list-group-item">Email         : wahyu.rooms@gmail.com</li>
  <li class="list-group-item">Instagram     : @wahyurooms</li>
</ul>

    @push('script')
        <script>
            alert("test")
        </script>
    @endpush

@endsection


