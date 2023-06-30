@extends('layouts.appUser')
@section('content')
<div class="container">
    <h1 class="text-center mt-5">Status Approval</h1>
   
    <tr>
      <td align="center">
          <table class="content" width="100%" cellpadding="0" cellspacing="0" role="presentation">
              <!-- Email Body -->
              @if(Session::has('type'))
              <div class="alert alert-{{ Session::get('type') }}" role="alert">
              <strong>{{ Session::get('title') }}</strong><br> {{ Session::get('message') }}
              </div>
              @endif
              <tr>
                  <td class="body" width="100%" cellpadding="0" cellspacing="0">
                      <table class="inner-body" align="center" width="80%" cellpadding="0" cellspacing="0" role="presentation">
                           <!-- Body content -->
                           <tr>
                              <td class="content-cell">
                                  <form action="{{ route('user.update', $event->id) }}" method="POST">
                                      @csrf
                                      @method('PUT')
                                      <div class="form-group row">
                                        <label for="name" class="col-4 col-form-label">Event Name</label> 
                                        <div class="col-8">
                                          <input id="name" name="name" type="text" class="form-control" value="{{ $event->name }}" readonly>
                                        </div>
                                      </div>
                                      <div class="form-group row">
                                        <label for="date" class="col-4 col-form-label">Event Date</label> 
                                        <div class="col-8">
                                          <input id="date" name="date" type="date" class="form-control" value="{{ $event->date }}" readonly>
                                        </div>
                                      </div>
                                      <div class="form-group row">
                                        <label for="type" class="col-4 col-form-label">Event Type</label> 
                                        <div class="col-8">
                    
                                          <input id="type" name="type" type="text" class="form-control" value="{{ $event->type }}" readonly>
                                        </div>
                                      </div>
                                      <div class="form-group row">
                                        <label for="status" class="col-4 col-form-label">Event Status</label> 
                                        <div class="col-8">
                                            <select id="status" name="status" class="form-control" required>
                                                <option value="approved" {{ $event->status === 'approved' ? 'selected' : '' }}>Approved</option>
                                                <option value="rejected" {{ $event->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                                              </select>
                                        </div>
                                      </div>
                                      <div class="form-group row">
                                        <label for="link" class="col-4 col-form-label">Link</label> 
                                        <div class="col-8">
                                          <input id="link" name="link" type="text" class="form-control" value="{{ $event->link }}" readonly>
                                        </div>
                                      </div>
                                      <div class="form-group row">
                                        <div class="offset-4 col-8">
                                          <button name="submit" type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                      </div>
                                    </form>
                              </td>
                          </tr>
                      </table>
                  </td>
              </tr>
          </table>
      </td>
    </tr>
  </table>
@endsection