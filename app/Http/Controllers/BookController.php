<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use App\Http\Resources\BookResource;
use App\Http\Resources\CategoryResource;
use App\Http\Requests\StoreBookRequest;
use Illuminate\Support\Facades\Cache;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categoryModel = app(Category::class);

        return $categoryModel->all();

        $firstCategory =  $categoryModel->find(4);







        $bookModel = app(Book::class);
        // return $bookModel->with('category')->first();
        // $booksResource =  new BookResource($bookModel->with('category')->withTrashed()->paginate('10'));

        $booksResource =  new BookResource($bookModel->with('category')->paginate('1'));
// return $booksResource;
        return view('books.index', ['books' => $booksResource]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoryModel = app(Category::class);

        Cache::forget('category');

        $categoriesResource = Cache::rememberForever('category', (60*5), function () use($categoryModel) {
            return CategoryResource::collection($categoryModel->all());
        });
// return $categoriesResource;
        return view('books.create', ['categories' => $categoriesResource]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookRequest $request)
    {
        $data = $request->validated();

        $bookModel = app(Book::class);

        $book = $bookModel->create($data);

        if($book){
            return redirect()->route('books.index')->with('success', 'Livro cadastrado com sucesso!');
        }
        else{
            return redirect()->route('books.index')->with('warning', 'Erro ao cadastrar o Livro!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bookModel = app(Book::class);
        $categoryModel = app(Category::class);
        $book = $bookModel->with('category')->find($id);
        $categoriesResource = Cache::remember('category', (60*5), function () use($categoryModel) {
            return CategoryResource::collection($categoryModel->all());
        });
        $bookResource =  new BookResource($book);
// return $bookResource;
        return view('books.edit', compact('bookResource','categoriesResource'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bookModel = app(Book::class);
        $book = $bookModel->find($id)->delete();

        return redirect()->route('books.index')->with('warning', 'Livro deletado com sucesso!');
    }
}
