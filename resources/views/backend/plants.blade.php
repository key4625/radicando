@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@push('after-styles')
<style>
    .table td {
        vertical-align: middle;
    }
</style>
@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Welcome :Name', ['name' => $logged_in_user->name])
        </x-slot>

        <x-slot name="body">

            <livewire:backend.plants-table />
        </x-slot>
    </x-backend.card>
@endsection
