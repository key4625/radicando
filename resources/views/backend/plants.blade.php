@extends('backend.layouts.app')

@section('title', __('Piante'))

@push('after-styles')
<style>
    .table td {
        vertical-align: middle;
    }
</style>
@section('content')
    <div class="clearfix">
        <a href="{{route('admin.piante.create')}}" class="btn btn-primary float-right mb-3"><i class="fas fa-plus"></i> Nuova pianta</a>
    </div>
    <livewire:backend.plants-table />

@endsection
