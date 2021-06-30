@extends('backend.layouts.app')

@section('title', __('Coltivazioni'))

@push('after-styles')

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Welcome :Name', ['name' => $logged_in_user->name])
        </x-slot>

        <x-slot name="body">

            <livewire:backend.cultivationslivewire />
        </x-slot>
    </x-backend.card>
@endsection
