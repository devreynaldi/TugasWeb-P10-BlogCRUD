{{-- 5. Validasi: error per field + old input --}}
<div class="mb-3">
    <label for="title" class="form-label">Judul</label>
    <input type="text" id="title" name="title"
           class="form-control @error('title') is-invalid @enderror"
           value="{{ old('title', $post->title ?? '') }}">
    @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="content" class="form-label">Isi Artikel</label>
    <textarea id="content" name="content" rows="6"
              class="form-control @error('content') is-invalid @enderror">{{ old('content', $post->content ?? '') }}</textarea>
    @error('content')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="image" class="form-label">Gambar (opsional)</label>
    @if (!empty($post?->image))
        <div class="mb-2">
            <img src="{{ asset('storage/' . $post->image) }}" class="img-thumbnail" style="max-height:120px" alt="">
        </div>
    @endif
    <input type="file" id="image" name="image" accept="image/*"
           class="form-control @error('image') is-invalid @enderror">
    @error('image')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="d-flex gap-2">
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary">Batal</a>
</div>
