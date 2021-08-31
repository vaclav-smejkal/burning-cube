@extends('layouts.app')

@section('title', 'Burning Cube | Editování balíčků')

@section('content')
    <section id="admin-package-edit" class="admin-edit-form">
        <div class="container">
            <div class="form-container">
                <h2 class="subtitle">Editování balíčku {{ $package->name }}</h2>
                <form action="{{ route('package.update', $package) }}" method="POST">
                    @csrf
                    @method("PUT")
                    <div class="form-floating">
                        <input type="text" class="form-control" name="name" id="name" value="{{ $package->name }}"
                            placeholder="Název kategorie">
                        <label for="name">Název</label>
                    </div>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="form-floating">
                        <input type="text" class="form-control" name="price" id="price" value="{{ $package->price }}"
                            placeholder="Cena">
                        <label for="price">Cena</label>
                    </div>
                    @error('price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Poznámka" name="comment"
                            id="comment">{{ $package->comment }}</textarea>
                        <label for="comment">Poznámka</label>
                    </div>
                    @error('comment')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" @if ($package->is_one_time) checked @endif name="is-one-time"
                            id="is-one-time">
                        <label class="form-check-label" for="is-one-time">
                            Jednorázový balíček
                        </label>
                    </div>
                    @error('is_one_time')
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
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
    </section>
@endsection
