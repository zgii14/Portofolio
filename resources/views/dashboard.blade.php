@extends("layouts.app")

@section("title")
    Dashboard Laundry
@endsection

@section("content")
    @if (Auth::user()->role == "admin")
        <h1>Dashboard Admin</h1>
    @endif
    <h1>Dashboard User</h1>
@endsection
