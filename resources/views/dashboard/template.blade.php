@extends('dashboard.layouts.master')

    @section('content-header')
        <section class="content-header">
            <h1>Compose</h1>
            <ol class="breadcrumb">
                <li>
                    <a href="#"><i class="fa fa-dashboard"></i> Home</a>
                </li>
                <li class="active">Messages</li>
            </ol>
        </section>
    @endsection

    @section('content')

    @endSection

    @section('scripts')
        @if (session('response'))
            <script>alert('{{ session('response') }}');</script>
        @endif
    @endSection
