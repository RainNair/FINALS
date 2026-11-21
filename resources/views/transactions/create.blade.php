@extends('layouts.app')
@section('content')
<div class="panel"><h1>Reserve a table</h1><p class="muted">Tell us when you are dining and we will prepare your table.</p><form method="POST" action="{{ route('transactions.store') }}">@csrf @include('transactions._form', ['submitLabel' => 'Create reservation'])</form></div>
@endsection
