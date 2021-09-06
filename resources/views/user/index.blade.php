@extends('layouts.app')
@section('title', 'Burning cube | Uživatelé')

@section('content')
    <section id="admin-package">
        <div class="container">
            <div class="flex-group">
                <div class="form-group">
                    <div class="form">
                        @if (session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="list">
                    <h2 class="subtitle">Seznam uživatelů</h2>
                    <div class="grid-items">
                        @foreach ($users as $user)
                            <div class="grid-item">
                                <div class="name">
                                    {{ $user->nick }}
                                </div>
                                <a href="{{ route('user.edit', $user->uuid) }}" class="btn btn-warning">
                                    <i class="fas fa-edit fa-fw"></i>
                                </a>
                                <form action="{{ route('user.destroy', $user->uuid) }}" method="POST">
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
