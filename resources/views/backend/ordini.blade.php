@extends('backend.layouts.app')

@section('title', __('Ordini'))

@push('after-styles')
<style>
@media print
{
  table { page-break-inside:avoid; }
}
</style>
@endpush


@section('content')
    <livewire:backend.ordinilivewire />
@endsection





