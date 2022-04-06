@extends('backend.layouts.app')

@section('title', __('Prodotti'))

@push('after-styles')
<style>
    .table td {
        vertical-align: middle;
    }
</style>
@section('content')
    <x-backend.card>
        <x-slot name="header">
            <div class="d-flex justify-content-between align-items-center">
                <div>@lang('Lista prodotti')</div>
                <a class="btn btn-primary" href="/admin/prodotti/create"><i class="fas fa-plus"></i> Crea prodotto</a>
            </div>
           
        </x-slot>

        <x-slot name="body">
            
            <livewire:backend.products-table />
        </x-slot>
    </x-backend.card>
@endsection
