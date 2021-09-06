@extends('layouts.app')

@section('title', 'Burning Cube | Editování serverů')

@section('content')
    <section id="admin-package-edit" class="admin-edit-form">
        <div class="container">
            <div class="form-container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="/admin/user">Uživatelé</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Editace</li>
                    </ol>
                </nav>
                <h2 class="subtitle">Editování uživatelů {{ $user->nickname }}</h2>
                <form action="{{ route('user.update', $user) }}" method="POST">
                    @csrf
                    @method("PUT")
                    <div class="form-floating">
                        <input type="text" class="form-control" name="nickname" id="nickname"
                            value="{{ $user->nickname }}" placeholder="Název uživatele">
                        <label for="name">Nick</label>
                    </div>
                    @error('nickname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="form-floating">
                        <input type="text" class="form-control" name="email" id="email" value="{{ $user->email }}"
                            placeholder="Email">
                        <label for="email">Email</label>
                    </div>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="btn-box">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-check"></i>
                        </button>
                        <a class="btn btn-danger" href="/admin/user">
                            <i class="fas fa-times"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
