<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Validator;

class ApiBookController extends Controller
{
    //
    public function index (){
    $books = Book::get();
    return response()->json($books);
    }

    public function show($id)
    {
        $book = Book::with('categories')->findOrFail($id);
        return response()->json($book);
    }

    public function store(Request $request)
    {
      
        $validator = Validator::make($request->all(), [
                'title'          => 'required|string|max:100',
                'desc'           => 'required|string',
                'img'            => 'required|image|mimes:jpg,png',
                'category_ids'   => 'required',
                'category_ids.*' => 'exists:categories,id',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json($errors);
        }

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
        $success = 'book created success';
        return response()->json($success);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title'          => 'required|string|max:100',
            'desc'           => 'required|string',
            'img'            => 'required|image|mimes:jpg,png',
            'category_ids'   => 'required',
            'category_ids.*' => 'exists:categories,id',
    ]);
    if ($validator->fails()) {
        $errors = $validator->errors();
        return response()->json($errors);
    }

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
        $book->categories()->sync($request->category_ids);
        $success = 'book Updated success';
        return response()->json($success);

    } 
    public function delete($id)
    {
        $book = Book::findOrFail($id);
        if ($book->img !== null) {
            unlink(public_path('uploads/books/') . $book->img);
        }
        $book->categories()->sync([]);
        $book->delete();
        $success = 'book deleted success';
        return response()->json($success);
    }

}
