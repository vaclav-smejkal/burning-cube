@extends('layouts.app')

@section('title', 'Burning Cube | Editování serverů')

@section('content')
    <section id="admin-package-edit" class="admin-edit-form">
        <div class="container">
            <div class="form-container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="/admin/server">Servery</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Editace</li>
                    </ol>
                </nav>
                <h2 class="subtitle">Editování serveru {{ $server->name }}</h2>
                <form action="{{ route('server.update', $server) }}" method="POST">
                    @csrf
                    @method("PUT")
                    <div class="form-floating">
                        <input type="text" class="form-control" name="name" id="name" value="{{ $server->name }}"
                            placeholder="Název kategorie">
                        <label for="name">Název</label>
                    </div>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="form-floating">
                        <input type="text" class="form-control" name="ip_address" id="ip_address"
                            value="{{ $server->ip_address }}" placeholder="Ip adresa">
                        <label for="ip_address">Ip adresa</label>
                    </div>
                    @error('ip_address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="form-floating">
                        <input type="text" class="form-control" name="port" id="port" value="{{ $server->port }}"
                            placeholder="Port">
                        <label for="port">Port</label>
                    </div>
                    @error('port')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="btn-box">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-check"></i>
                        </button>
                        <a class="btn btn-danger" href="/admin/server">
                            <i class="fas fa-times"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
