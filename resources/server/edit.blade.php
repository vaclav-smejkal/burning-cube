@extends('layouts.app')
@section('title', 'Burning cube | Balíčky')

@section('content')
    <section id="admin-package">
        <div class="container">
            <div class="flex-group">
                <div class="form-group">
                    <div class="form">
                        <h2 class="subtitle">Přidat nový balíček</h2>
                        <form action="{{ route('package.store') }}" method="POST">
                            @csrf
                            <div class="form-floating">
                                <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}"
                                    placeholder="Název kategorie">
                                <label for="name">Název</label>
                            </div>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div class="form-floating">
                                <input type="text" class="form-control" name="price" id="price"
                                    value="{{ old('price') }}" placeholder="Cena">
                                <label for="price">Cena</label>
                            </div>
                            @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Poznámka" name="comment"
                                    id="comment">{{ old('comment') }}</textarea>
                                <label for="comment">Poznámka</label>
                            </div>
                            @error('comment')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="is-one-time" id="is-one-time"
                                    @if (old('is_one_time')) checked @endif>
                                <label class="form-check-label" for="is-one-time">
                                    Jednorázový balíček
                                </label>
                            </div>
                            @error('is_one_time')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <button type="submit" class="btn btn-primary">Přidat</button>
                        </form>
                        @if (session()->has('message'))
                            <div class="message success">
                                {{ session()->get('message') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="list">
                    <h2 class="subtitle">Seznam balíčků</h2>
                    <div class="grid-items">
                        @foreach ($packages as $package)
                            <div class="grid-item">
                                <div class="name">
                                    {{ $package->name }}
                                </div>
                                <a href="{{ route('package.edit', $package->sanitized_name) }}" class="btn btn-warning">
                                    <i class="fas fa-edit fa-fw"></i>
                                </a>
                                <form action="{{ route('package.destroy', $package->sanitized_name) }}" method="POST">
                                    @csrf
                                    @method("delete")
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-trash fa-fw"></i>
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
