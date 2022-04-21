@extends('backend.layouts.app')

@section('title', __('Animali'))

@push('after-styles')
<style>
    .table td {
        vertical-align: middle;
    }
</style>
@section('content')
    <livewire:backend.animals-table />
@endsection
