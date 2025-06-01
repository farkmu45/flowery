@extends('layouts.admin')

@section('content')
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold mb-4 py-3">
      <span class="text-muted fw-light"> Flower/</span> List
    </h4>
    <div class="card">
      <div class="d-flex align-items-end row">
        <div class="col-sm-12">
          <div class="card-body">
            <div class="d-flex justify-content-between">
              <h5 class="card-title text-primary">Flowers Page</h5>
              <a href="{{ route('flower.create') }}">
                <button class="btn btn-primary">Add Flower</button>
              </a>
            </div>
            <table class='table'>
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Flowers Name</th>
                  <th>Picture</th>
                  <th>Characteristic</th>
                  <th>Meanings of Flowers</th>
                  <th>Details</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($flower as $key => $flower)
                  <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $flower->flower_name }}</td>
                    <td>
                      <img src="{{ asset($flower->picture) }}" alt="" style="width: 100px">
                    </td>
                    <td>{{ $flower->character }}</td>
                    <td>{{ $flower->meaning }}</td>
                    <td>{{ $flower->details }}</td>
                    <td>
                      <div class="d-flex">
                        <a href="{{ route('flower.edit', $flower) }}">
                          <button class="btn btn-sm btn-primary">Edit</button>
                        </a>
                        &nbsp
                        <form onsubmit="return confirm('Are you sure to delete it?')"
                          action="{{ route('flower.destroy', $flower) }}" method="post">
                          @csrf
                          @method('DELETE')
                          <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                        </form>
                      </div>
                    </td>

                  </tr>
                @endforeach

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@stop
@push('js')
  <form id="delete-form" action="" method="post">
    @method('delete')
    @csrf
  </form>
  <script>
    $('#example2').DataTable({
      "responsive": true,
    });

    function notificationBeforeDelete(event, el) {
      event.preventDefault();
      if (confirm('Are you sure want to delete this data ?')) {
        $("#delete-form").attr('action', $(el).attr('href'));
        $("#delete-form").submit();
      }
    }
  </script>
@endpush
