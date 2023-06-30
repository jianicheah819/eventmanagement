@extends('layouts.appAdmin')
@section('content')
<div class="container">
   
    <h1 class="text-center mt-5">Manage Event</h1>
    {{-- <h5 class="text-center mt-5">Status of bus that is Full is not allowed to edit and delete.</h5> --}}
      
        <table class="table">
            <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Event Name</th>
                                <th scope="col">Event Date</th>
                                <th scope="col">Event Type</th>
                                <th scope="col">Status</th>
                                <th scope="col">Link</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($events as $event)
                                <tr>
                                    <th scope="row">{{ $event->id }}</th>
                                    <td>{{ $event->name }}</td>
                                    <td>{{ $event->date }}</td>
                                    <td>{{ $event->type }}</td>
                                    <td>{{ $event->status }}</td>
                                    <td>{{ $event->link }}</td>
                                    <td>
                                        <a href="{{ route ('event.edit', $event->id) }}" class="btn btn-warning">EDIT</a>
                                        <form action="{{ route ('event.destroy', $event->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger">DELETE</button>
                                        </form>
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
@endsection