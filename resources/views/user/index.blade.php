@extends('layouts.app')
@section('title', 'Burning cube | Uživatelé')

@section('content')
    <section id="admin-package">
        <div class="container">
            <div class="flex-group">
                <div class="list list-users">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/admin"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Uživatelé</li>
                        </ol>
                    </nav>
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    <h2 class="subtitle">Seznam uživatelů</h2>
                    <div class="grid-users">
                        @foreach ($users as $user)
                            <div class="grid-item">
                                <div class="name">
                                    <div>
                                        {{ $user->email }}
                                    </div>
                                    @isset($user->nickname)
                                        <div>
                                            {{ $user->nickname }}
                                        </div>
                                    @endisset
                                </div>
                                <div class="btn-box">
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
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
