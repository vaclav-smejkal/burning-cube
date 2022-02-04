@extends('layouts.app')

@section('title', 'After-Life | Editování e-mailů')

@section('content')
    <section id="admin-package-edit" class="admin-edit-form">
        <div class="container">
            <div class="form-container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="/admin/email">E-maily</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Editace</li>
                    </ol>
                </nav>
                <h2 class="subtitle">Editování balíčku {{ $email->template }}</h2>
                <form action="{{ route('email.update', $email) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <div class="form-floating">
                        <input type="text" class="form-control" name="subject" id="subject"
                            value="{{ $email->subject }}" placeholder="Předmět">
                        <label for="subject">Předmět</label>
                    </div>
                    @error('subject')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="form-floating">
                        <textarea type="text" class="form-control" name="body" id="body"
                            placeholder="Cena">{{ $email->body }}</textarea>
                        <label for="body">Obsah e-mailu</label>
                    </div>
                    @error('body')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="btn-box">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-check"></i>
                        </button>
                        <a class="btn btn-danger" href="/admin/package">
                            <i class="fas fa-times"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
