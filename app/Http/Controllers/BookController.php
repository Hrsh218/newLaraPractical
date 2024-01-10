<?php

namespace App\Http\Controllers;

use App\Http\Requests\book\create;
use App\Models\Book;
use App\Models\Cateogry;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('category')->paginate(10);
        return view('pages.books.index', compact('books'));
    }

    public function create()
    {
        $categories = Cateogry::all();
        return view('pages.books.create', compact('categories'));
    }

    public function store(create $request)
    {
        DB::beginTransaction();
        try {

            $book = Book::create([
                'name' => $request->name,
                'cateogry_id' => $request->category,
                'author_name' => $request->author_name,
                'published_date' => $request->published_date
            ]);
            if ($request->hasfile('image')) {
                $file = $request->file('image');
                $extenstion = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extenstion;
                $file->storeAs('public/images/', $filename);
                $book->image = $filename;
                $book->save();
            }

            if ($book) {
                \App\Helpers\LogActivity::addToLog('Store Book');
                DB::commit();
                return redirect()->route('book.list')->with(['messages', 'Book has been created sucessfully.']);
            } else {
                \App\Helpers\LogActivity::addToLog('Something error in book store.');
                DB::rollBack();
                return redirect()->route('book.create')->with(['messages', 'Something went to wrong.']);
            }
        } catch (Exception $e) {
            \App\Helpers\LogActivity::addToLog('Something error in book store.');
            DB::rollBack();
            Log::info($e->getMessage());
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        \App\Helpers\LogActivity::addToLog('Edit Book');
        $book = Book::with('category')->find($id);
        $categories = Cateogry::all();
        return view('pages.books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $book = Book::find($id);
            $book->name = isset($request->name) ? $request->name : $book->name;
            $book->cateogry_id = isset($request->category) ? $request->category : $book->cateogry_id;
            $book->author_name = isset($request->author_name) ? $request->author_name : $book->author_name;
            $book->published_date = isset($request->published_date) ? $request->published_date : $book->published_date;
            if ($request->hasfile('image')) {
                if (isset($book->logo) || !empty($book->image)) {
                    if (Storage::exists('public/images/' . $book->image)) {
                        Storage::delete('public/images/' . $book->image);
                    }
                }
                $file = $request->file('image');
                $extenstion = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extenstion;
                $file->storeAs('public/images/', $filename);
                $book->image = $filename;
            }

            if ($book->save()) {
                \App\Helpers\LogActivity::addToLog('Update book data.');
                DB::commit();
                return redirect()->route('book.list')->with(['messages', 'Your book is sucessfully edited.']);
            } else {
                \App\Helpers\LogActivity::addToLog('Something went to wrong in book update data.');
                DB::rollBack();
                return redirect()->route('book.edit')->with(['messages', 'Something went to wrong.']);
            }
        } catch (Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            Log::info($e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            \App\Helpers\LogActivity::addToLog('Call book delete api.');
            $book = Book::find($id);
            if (isset($book->logo) || !empty($book->logo)) {
                if (Storage::exists('public/images' . $book->logo)) {
                    Storage::delete('public/images' . $book->logo);
                }
            }
            if ($book->delete()) {
                return redirect()->route('book.list')->with(['messages', 'Your book is sucessfully deleted.']);
            } else {
                return redirect()->route('book.list')->with(['messages', 'Something went to wrong.']);
            }
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
        }
    }
}
