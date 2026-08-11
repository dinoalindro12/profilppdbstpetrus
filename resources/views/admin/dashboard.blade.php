{{--
    File ini dipertahankan untuk backward compatibility saja.
    AdminController sekarang me-dispatch langsung ke admin.dashboards.*
    berdasarkan role user — file ini tidak lagi dirender secara langsung.
--}}
@extends('admin.layouts.app')
@section('title', 'Dashboard')
@section('content')
    <div class="sp-card p-8 text-center">
        <p class="text-cobalt-500">Mengalihkan ke dashboard Anda...</p>
        <script>window.location.href = "{{ route('admin.dashboard') }}";</script>
    </div>
@endsection
