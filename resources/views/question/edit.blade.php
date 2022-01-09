@extends('layouts.app')

@section('title', 'After-Life | Editování otázek')

@section('content')
    <section id="admin-package-edit" class="admin-edit-form">
        <div class="container">
            <div class="form-container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="/admin/question">FAQ</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Editace</li>
                    </ol>
                </nav>
                <h2 class="subtitle">Editování otázek {{ $question->name }}</h2>
                <form action="{{ route('question.update', $question) }}" method="POST">
                    @csrf
                    @method("PUT")
                    <input type="hidden" name="uuid" value="{{ $question->uuid }}">
                    <div class="form-floating">
                        <input type="text" class="form-control" name="question" id="question"
                            value="{{ $question->question }}" placeholder="Otázka">
                        <label for="question">Otázka</label>
                    </div>
                    @error('question')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="form-floating textarea-floating">
                        <textarea class="form-control" placeholder="Odpověď" name="answer"
                            id="answer">{{ $question->answer }}</textarea>
                        <label for="answer">Odpověď</label>
                    </div>
                    @error('answer')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="btn-box">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-check"></i>
                        </button>
                        <a class="btn btn-danger" href="/admin/question">
                            <i class="fas fa-times"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
