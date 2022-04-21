@extends('backend.layouts.app')

@section('title', __('Piante'))

@push('after-styles')
<style>
    .table td {
        vertical-align: middle;
    }
</style>
@section('content')
    <livewire:backend.plants-table />

@endsection
