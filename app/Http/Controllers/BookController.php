<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd(Book::with('categories')->paginate(5));
        return view('book.index', [
            'books' => Book::with('categories')->paginate(5)
        ]);
    }

    public function summary()
    {
        return "INI HALAMAN CUSTOM SUMMARY";
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('book.create', [
            'categories' => Category::select('id', 'name')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        $formData = $request->validated();

        try {
            $formData['cover'] = $request->file('cover')->store('book-cover', 'public');
            $formData['created_by'] = Auth::user()->id;
            $formData['Update_by'] = Auth::user()->id;

            $book = Book::create($formData);
            $book->categories()->attach($formData['category']);

            return redirect()->route('book.index')->with('success', 'Book Berhasil Ditambahkan');
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        return view('book.edit', [
            'book' => $book,
            'categories' => Category::select('id', 'name')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        // dd($request->validated(), $book);

        $formData = $request->validated();

        try {
            // Cek apakah ada request cover file (mengubah gambar)
            if ($request->hasFile('cover')) {
                // hapus file lama dari storage
                Storage::delete('public/' . $book->cover);
                // input file baru ke storage
                $formData['cover'] = $request->file('cover')->store('book-cover', 'public');
            }
            $formData['Update_by'] = Auth::user()->id;
            // update data buku
            $book->update($formData);
            // update data kategori menggunakan sync
            //sync hanya id
            // $book->categories()->sync($formData['category']);
            //sync dengan tambahan field
            $book->categories()->syncWithPivotValues($formData['category'], ['updated_at' => now()] );

            return redirect()->route('book.index')->with('success', 'Book Berhasil Diubah!');
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', 'Error Updating : ', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        try {
            // 1. Menghapus relasi kategori
            $book->categories()->detach();
            // 2. menghapus file cover dari storage
            if ($book->cover) {
                Storage::delete('public/'. $book->cover);
            }
            // 3.hapus data buku
            $book->delete();
            return redirect()->route('book.index')->with('success', 'Berhasil Hapus Data Book!');
        } catch (\Exception $e) {
            return redirect()->route('book.index')->with('error', 'Error Deleting : ', $e->getMessage());
        }
    }
}
