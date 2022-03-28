<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;

class BookController extends Controller
{
    //
    public function index()
    {
        $books = Book::orderBy('id', 'DESC')->get();
        return view('books.index', compact('books'));
    }
    public function withsearch()
    {
        $books = Book::orderBy('id', 'DESC')->get();
        return view('books.indexwithsearch', compact('books'));
    }

    public function show($id)
    {
        $book = Book::findOrFail($id);
        return view('books.show', compact('book'));
    }

 public function search(Request $request)
    {
        $keyword = $request->keyword;
        $books = Book::where('title','like',"%$keyword%")->get();
        return response()->json($books);
    }
    public function create()
    {
        $categories = Category::select('id', 'name')->get();
        return view('books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'          => 'required|string|max:100',
            'desc'           => 'required|string',
            'img'            => 'required|image|mimes:jpg,png',
            'category_ids'   => 'required',
            'category_ids.*' => 'exists:categories,id',

        ]);
        $img = $request->file('img');
        $ext = $img->getClientOriginalExtension();
        $name = 'book' . uniqid() . ".$ext";
        $img->move(public_path('uploads/books'), $name);
        $book = Book::create([
            'title' => $request->title,
            'desc' => $request->desc,
            'img' => $name,
        ]);
        $book->categories()->sync($request->category_ids);

        return redirect(route('books.index'));
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'desc' => 'required|string',
            'img' => 'nullable|image|mimes:jpg,png',
        ]);

        $book = Book::findOrFail($id);
        $name = $book->img;
        if ($request->hasFile('img')) {
            if ($name !== null) {
                unlink(public_path('uploads/books/') . $name);
            }
            $img = $request->file('img');
            $ext = $img->getClientOriginalExtension();
            $name = 'book' . uniqid() . ".$ext";
            $img->move(public_path('uploads/books'), $name);
        }
        $book->update([
            'title' => $request->title,
            'desc' => $request->desc,
            'img' => $name,
        ]);
        return redirect(route('books.index'));
    }

    public function delete($id)
    {
        $book = Book::findOrFail($id);
        if ($book->img !== null) {
            unlink(public_path('uploads/books/') . $book->img);
        }
        $book->delete();
        return redirect(route('books.index'));
    }
}
