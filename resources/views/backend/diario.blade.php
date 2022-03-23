@extends('backend.layouts.app')

@section('title', __('Diario'))

@push('after-styles')

@section('content')
  
    <livewire:backend.operationlivewire />
    
@endsection
