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
        $this->authorize('create', Book::class);
        $request->validate([
            'judul' => 'required|string',
            'penulis' => 'required|string',
            'tahun_terbit' => 'required|integer',
            'deskripsi' => 'required|string',
        ]);

        $book = Book::create($request->all());
        return response()->json($book, 201);
    }

    public function show($id)
    {
        return response()->json(Book::findOrFail($id), 200);
    }

    public function update(Request $request, $id)
    {
        $this->authorize('update', Book::class);
        $book = Book::findOrFail($id);
        $book->update($request->all());

        return response()->json($book, 200);
    }

    public function destroy($id)
    {
        $this->authorize('delete', Book::class);
        Book::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}