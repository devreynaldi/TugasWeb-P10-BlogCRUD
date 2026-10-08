@extends('layouts.app')

@section('title', 'Daftar Post')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
        <h1 class="h3 mb-0">{{ request()->boolean('trashed') ? '🗑️ Sampah' : 'Daftar Post' }}</h1>

        <div class="d-flex gap-2">
            <form action="{{ route('posts.index') }}" method="GET" class="d-flex gap-2">
                @if (request()->boolean('trashed'))
                    <input type="hidden" name="trashed" value="1">
                @endif
                <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Cari judul / isi...">
                <button class="btn btn-outline-secondary">Cari</button>
            </form>

            @if (request()->boolean('trashed'))
                <a href="{{ route('posts.index') }}" class="btn btn-outline-dark">Kembali</a>
            @else
                <a href="{{ route('posts.index', ['trashed' => 1]) }}" class="btn btn-outline-danger">Sampah</a>
            @endif
        </div>
    </div>

    <div class="row g-3">
        @forelse ($posts as $post)
            <div class="col-md-6 col-lg-4">
                <x-card class="h-100">
                    @if ($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid rounded mb-3" alt="{{ $post->title }}">
                    @endif
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p class="card-text text-muted">{{ Str::limit($post->content, 100) }}</p>
                    <small class="text-secondary">{{ $post->created_at->diffForHumans() }}</small>

                    <x-slot:footer>
                        @if ($post->trashed())
                            <form action="{{ route('posts.restore', $post->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-sm btn-success">Pulihkan</button>
                            </form>
                        @else
                            <div class="d-flex gap-2">
                                <a href="{{ route('posts.show', $post) }}" class="btn btn-sm btn-info text-white">Lihat</a>
                                <a href="{{ route('posts.edit', $post) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('posts.destroy', $post) }}" method="POST"
                                      onsubmit="return confirm('Hapus post ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </div>
                        @endif
                    </x-slot:footer>
                </x-card>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center text-muted py-5">Belum ada post.</div>
            </div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $posts->links() }}
    </div>
@endsection
