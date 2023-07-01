@extends('layouts.appAdmin')
<!DOCTYPE html>
<html>
<head>
    <title>Add Event Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-group textarea {
            height: 100px;
        }

        .form-group button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .form-group button:hover {
            background-color: #45a049;
        }
    </style>
</head>
@section('content')
<div class="container">
    <h2>New Event</h2>
    <form method="POST" action="{{ route ('event.store') }}">
        @csrf
        <div class="form-group">
            <label for="name">Event Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="date">Event Date:</label>
            <input type="date" id="date" name="date" required>
        </div>
        <div class="form-group">
            <label for="type">Event Type:</label>
            <select id="type" name="type" required>
                <option value="faculty">Peringkat Faculty</option>
                <option value="university">Peringkat University</option>
                <option value="negeri">Peringkat Negeri</option>
                <option value="antarabangsa">Peringkat Antarabangsa</option>
            </select>
        </div>
        <div class="form-group">
            <label for="status">Event Status:</label>
            <select id="status" name="status" required>
                <option value="applied">Applied</option>
                {{-- <option value="approved">Approved</option>
                <option value="rejected">Rejected</option> --}}
            </select>
        </div>
        <div class="form-group">
            <label for="link">Link:</label>
            <b>Make sure the link is allow to access without request and have included the paperwork and pictures if available</b>
            <input type ='text' id="link" name="link" required>
        </div>
        <div class="form-group">
            <button type="submit">Submit</button>
        </div>
    </form>
</div>
@endsection