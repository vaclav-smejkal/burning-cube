@extends('layouts.app')
@section('title', 'Burning cube | Otázky')

@section('content')
    <section id="admin-package">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin"><i class="fas fa-home"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">FAQ</li>
                </ol>
            </nav>
            <div class="flex-group">
                <div class="form-group">
                    <div class="form">
                        <h2 class="subtitle">Přidat novou otázku</h2>
                        <form action="{{ route('question.store') }}" method="POST">
                            @csrf
                            <div class="form-floating">
                                <input type="text" class="form-control" name="question" id="question"
                                    value="{{ old('question') }}" placeholder="Otázka">
                                <label for="question">Otázka</label>
                            </div>
                            @error('question')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div class="form-floating textarea-floating">
                                <textarea class="form-control" placeholder="Odpověď" name="answer"
                                    id="answer">{{ old('answer') }}</textarea>
                                <label for="answer">Odpověď</label>
                            </div>
                            @error('answer')
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
                    <h2 class="subtitle">Seznam Otázek</h2>
                    <div class="grid-items">
                        @foreach ($questions as $question)
                            <div class="grid-item">
                                <div class="name">
                                    {{ $question->question }}
                                </div>
                                <div class="btn-box">
                                    <a href="{{ route('question.edit', $question->uuid) }}" class="btn btn-warning">
                                        <i class="fas fa-edit fa-fw"></i>
                                    </a>
                                    <form action="{{ route('question.destroy', $question->uuid) }}" method="POST">
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
