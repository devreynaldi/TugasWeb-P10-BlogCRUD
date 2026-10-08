<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Throwable;

// 2. Resource controller (7 method)
class PostController extends Controller
{
    private function rules(): array
    {
        return [
            'title'   => 'required|string|min:5|max:150',
            'content' => 'required|string|min:10',
            'image'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }

    private function messages(): array
    {
        return [
            'title.required'   => 'Judul wajib diisi.',
            'title.min'        => 'Judul minimal :min karakter.',
            'title.max'        => 'Judul maksimal :max karakter.',
            'content.required' => 'Isi artikel wajib diisi.',
            'content.min'      => 'Isi artikel minimal :min karakter.',
            'image.image'      => 'File harus berupa gambar.',
            'image.mimes'      => 'Format gambar: jpg, jpeg, png, atau webp.',
            'image.max'        => 'Ukuran gambar maksimal 2 MB.',
        ];
    }

    // 1/7 - daftar + pencarian + pagination (8)
    public function index(Request $request)
    {
        $posts = Post::search($request->q)
            ->when($request->boolean('trashed'), fn ($q) => $q->onlyTrashed())
            ->latest()
            ->paginate(6)
            ->withQueryString();

        return view('posts.index', compact('posts'));
    }

    // 2/7 - form tambah
    public function create()
    {
        return view('posts.create');
    }

    // 3/7 - simpan
    public function store(Request $request)
    {
        $data = $request->validate($this->rules(), $this->messages());

        try {
            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('posts', 'public');
            }
            Post::create($data);
        } catch (Throwable $e) {
            return back()->withInput()->with('error', 'Gagal menyimpan post: ' . $e->getMessage());
        }

        return redirect()->route('posts.index')->with('success', 'Post berhasil ditambahkan.');
    }

    // 4/7 - detail (Route Model Binding)
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    // 5/7 - form edit (Route Model Binding)
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    // 6/7 - update
    public function update(Request $request, Post $post)
    {
        $data = $request->validate($this->rules(), $this->messages());

        try {
            if ($request->hasFile('image')) {
                if ($post->image) {
                    Storage::disk('public')->delete($post->image);
                }
                $data['image'] = $request->file('image')->store('posts', 'public');
            }
            $post->update($data);
        } catch (Throwable $e) {
            return back()->withInput()->with('error', 'Gagal memperbarui post: ' . $e->getMessage());
        }

        return redirect()->route('posts.show', $post)->with('success', 'Post berhasil diperbarui.');
    }

    // 7/7 - hapus (soft delete)
    public function destroy(Post $post)
    {
        try {
            $post->delete();
        } catch (Throwable $e) {
            return back()->with('error', 'Gagal menghapus post.');
        }

        return redirect()->route('posts.index')->with('success', 'Post dipindahkan ke sampah.');
    }

    // Bonus: restore
    public function restore(int $id)
    {
        Post::onlyTrashed()->findOrFail($id)->restore();

        return redirect()->route('posts.index')->with('success', 'Post berhasil dipulihkan.');
    }
}
