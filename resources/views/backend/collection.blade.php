@extends('backend.layouts.app')

@section('title', __('Raccolto'))

@push('after-styles')

@section('content')
    <x-backend.card>
        <x-slot name="header">
            Il raccolto di oggi..
        </x-slot>

        <x-slot name="body">

            <livewire:backend.collectionlivewire />
        </x-slot>
    </x-backend.card>
@endsection
