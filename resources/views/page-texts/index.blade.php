@extends('layouts.app')
@section('title', 'After-Life | Stránka')

@section('content')
    <section id="admin-package">
        <div class="container">
            <div class="flex-group">
                <div class="list list-users">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/admin"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Stránka</li>
                        </ol>
                    </nav>
                    <h2 class="subtitle">Seznam textů</h2>
                    <div class="grid-users">
                        @foreach ($pageTexts as $pageText)
                            <div class="grid-item">
                                <div class="name">
                                    {{ $pageText->name }}
                                </div>
                                <div class="btn-box">
                                    <a href="{{ route('page-texts.edit', $pageText->uuid) }}" class="btn btn-warning">
                                        <i class="fas fa-edit fa-fw"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @if (session()->has('message'))
                <div class="alert alert-success" role="alert">
                    {{ session()->get('message') }}
                </div>
            @endif
        </div>
    </section>
@endsection
