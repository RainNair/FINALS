@extends('layouts.app')
@section('content')
<div class="panel"><h1>Manage reservation</h1><form method="POST" action="{{ route('transactions.update', $transaction) }}">@csrf @method('PUT') @include('transactions._form', ['submitLabel' => 'Save reservation'])</form></div>
@endsection
