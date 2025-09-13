@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900">
        <actors-table :actors="{{ json_encode($actors) }}"></actors-table>
    </div>
@endsection