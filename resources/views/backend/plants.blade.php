@extends('backend.layouts.app')

@section('title', __('Piante'))

@push('after-styles')
<style>
    .table td {
        vertical-align: middle;
    }
</style>
@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Lista piante')
        </x-slot>

        <x-slot name="body">

            <livewire:backend.plants-table />
        </x-slot>
    </x-backend.card>
@endsection
