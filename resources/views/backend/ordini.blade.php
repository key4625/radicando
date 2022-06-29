@extends('backend.layouts.app')

@section('title', __('Ordini'))

@push('after-styles')
<style>
@media print
{
  table { page-break-after:auto }
  tr    { page-break-inside:avoid; page-break-after:auto }
  td    { page-break-inside:avoid; page-break-after:auto }
  div   { page-break-inside:avoid; }
  thead { display:table-header-group }
  tfoot { display:table-footer-group }
}
</style>
@endpush


@section('content')
    <livewire:backend.ordinilivewire />
@endsection





