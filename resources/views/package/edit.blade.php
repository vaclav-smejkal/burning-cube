@extends('layouts.app')

@section('title', 'After-Life | Editování balíčků')

@section('content')
    <section id="admin-package-edit" class="admin-edit-form">
        <div class="container">
            <div class="form-container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="/admin/package">Balíčky</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Editace</li>
                    </ol>
                </nav>
                <h2 class="subtitle">Editování balíčku {{ $package->name }}</h2>
                <form action="{{ route('package.update', $package) }}" method="POST" enctype="multipart/form-data">
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
                        <div class="currency">
                            Kč
                        </div>
                    </div>
                    @error('price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="form-floating">
                        <input type="text" class="form-control" name="smsprice" id="smsprice"
                            value="{{ $package->sms_price }}" placeholder="Cena">
                        <label for="smsprice">Cena SMS</label>
                        <div class="currency">
                            Kč
                        </div>
                    </div>
                    @error('smsprice')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div id="editor">
                        {!! $package->comment !!}
                    </div>
                    <input type="hidden" id="editor-input" name="comment">
                    @error('comment')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <label for="color" class="form-label">Barva</label>
                    <input type="color" class="form-control form-control-color" name="color" id="color"
                        value="{{ $package->color }}" title="Vyber barvu">
                    @error('color')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="file-group">
                        <div class="file-input">
                            <label for="image" class="form-label">Náhledový obrázek</label>
                            <input class="form-control" type="file" id="image" name="image">
                        </div>
                        <div class="image">
                            <img src="{{ asset($package->image) }}" alt="{{ $package->name }}">
                        </div>
                    </div>
                    @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="form-check">
                        <input class="form-check-input" name="is-one-time" type="checkbox" @if ($package->is_one_time) checked @endif
                            id="is-one-time" value="true">
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
            </div>
        </div>
    </section>
@endsection
