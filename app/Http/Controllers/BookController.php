<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        return response()->json(Book::all(), 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'tahun_terbit' => 'required|integer',
            'deskripsi' => 'required|string',
        ]);

        $book = Book::create($validated);
        return response()->json($book, 201);
    }

    public function show($id)
    {
        return response()->json(Book::findOrFail($id), 200);
    }

    public function update(Request $request, $id)
    {
        $this->authorize('update', Book::class);

        $validated = $request->validate([
            'judul' => 'sometimes|string|max:255',
            'penulis' => 'sometimes|string|max:255',
            'tahun_terbit' => 'sometimes|integer',
            'deskripsi' => 'sometimes|string',
        ]);

        $book = Book::findOrFail($id);
        $book->update($validated);

        return response()->json($book, 200);
    }

    public function destroy($id)
    {
        $this->authorize('delete', Book::class);
        Book::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}