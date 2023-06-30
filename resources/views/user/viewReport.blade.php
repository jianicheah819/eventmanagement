@extends('layouts.appUser')

@section('content')
<main role="main" class="container">
    <h1 class="text-center mt-5">Report</h1>
    <div class="button-container">
      <a href="{{ route('event.generatePdf') }}" class="btn btn-primary">Generate PDF</a>
    </div>
    <br>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Event Name</th>
                <th scope="col">Event Date</th>
                <th scope="col">Event Type</th>
               <th scope ="col">Date Created</th>
            </tr>
        </thead>
        <tbody>
             @foreach ($events as $event)
             <tr>
            <th scope="row">{{ $event->id}}</th>
              <td>{{ $event->name }}</td>
              <td>{{ $event->date }}</td>
              <td>{{ $event->type }}</td>
              <td>{{ $event->created_at }}</td>
            </tr>
      @endforeach
          </tbody>
    </table>
</main>
@endsection