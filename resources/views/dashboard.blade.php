@extends('layouts.app')

@section('content')
    <div class="container">

        <livewire:dashboard.work-order-table />

        <livewire:dashboard.work-order-edit-modal />
        <livewire:dashboard.ticket-assign-modal />
        <livewire:dashboard.work-order-progress-modal />

    </div>
@endsection
