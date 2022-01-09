@extends('layouts.app')
@section('title', 'After-Life | Servery')

@section('content')
    <section id="admin-package">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin"><i class="fas fa-home"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Servery</li>
                </ol>
            </nav>
            <div class="flex-group">
                <div class="form-group">
                    <div class="form">
                        <h2 class="subtitle">Přidat nový server</h2>
                        <form action="{{ route('server.store') }}" method="POST">
                            @csrf
                            <div class="form-floating">
                                <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}"
                                    placeholder="Název">
                                <label for="name">Název</label>
                            </div>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div class="form-floating">
                                <input type="text" class="form-control" name="ip_address" id="ip_address"
                                    value="{{ old('ip_address') }}" placeholder="Ip adresa">
                                <label for="ip_address">Ip adresa</label>
                            </div>
                            @error('ip_address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div class="form-floating">
                                <input type="text" class="form-control" name="port" id="port" value="{{ old('port') }}"
                                    placeholder="Port">
                                <label for="port">Port</label>
                            </div>
                            @error('port')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <button type="submit" class="btn btn-primary">Přidat</button>
                        </form>
                        @if (session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="list">
                    <h2 class="subtitle">Seznam serverů</h2>
                    <div class="grid-items">
                        @foreach ($servers as $server)
                            <div class="grid-item">
                                <div class="name">
                                    {{ $server->name }}
                                </div>
                                <div class="btn-box">
                                    <a href="{{ route('server.edit', $server->sanitized_name) }}" class="btn btn-warning">
                                        <i class="fas fa-edit fa-fw"></i>
                                    </a>
                                    <form action="{{ route('server.destroy', $server->sanitized_name) }}" method="POST">
                                        @csrf
                                        @method("delete")
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fas fa-trash fa-fw"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
