<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {              
        $search = $request->input('search');        
        $books  = Book ::join('book_author','book.id','=','book_author.book_id')
         ->join('author','author.id','=','book_author.author_id') 
         ->join('rubric','rubric.id','=','book.rubric_id') 
         ->leftjoin('files','files.id','=','book.file_id') 
         ->where("author.surname", "like", "{$search}". "%")
         ->orWhere("book.name", "like", "%"."{$search}". "%")
         ->groupBy('book_author.book_id')
         ->select('book.id','book.name','book.publishplace','book.publishyear','book.pages','rubric.title','author.surname','files.filepath','files.filename') 
         ->paginate(10); 
         $books->appends(['search' => $search]);       
         return view('books.index', compact('books'));   
        //$books = Book::paginate(10);         
         /*$books  = Book ::join('book_author','book.id','=','book_author.book_id')
         ->join('author','author.id','=','book_author.author_id') 
         ->join('rubric','rubric.id','=','book.rubric_id') 
         ->leftjoin('files','files.id','=','book.file_id') 
         ->groupBy('book_author.book_id')
         //->where("author.surname", "like", 'Копытова'. "%")
         ->select('book.id','book.name','book.publishplace','book.publishyear','book.pages','rubric.title','author.surname','files.filepath','files.filename') 
         ->paginate(10);                          
         //->get(['book.id', 'book.name', 'book.publishplace','book.publishyear','book.pages','rubric.title','author.surname']);
         
        
       // $books = Book :: has('authors')->where("surname", "like", 'Лукин'. "%")->paginate(20);
        //$books = Book::where("name", "like", 'А'. "%")->paginate(20);       
        //$authors = Author::where("surname", "like", 'Ильин'. "%");*/               
        //return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $book = new Book();  
        $book->name =  $request->get('name');  
        $book->additionalname = $request->get('additionalname');  
        $book->response = $request->get('response');  
        $book->additionalresponse = $request->get('additionalresponse');  
        $book->publishplace = $request->get('publishplace'); 
        $book->publishhouse = $request->get('publishhouse'); 
        $book->publishyear = $request->get('publishyear'); 
        $book->tom = $request->get('tom'); 
        $book->pages = $request->get('pages');
        $book->authorsign = $request->get('authorsign');   
        $book->code = $request->get('code');
        $book->numbersk = $request->get('numbersk');        
        $book->recieptdate = $request->get('recieptdate'); 
        $book->rubric_id = $request->get('rubric'); 
        $book->cost = $request->get('cost');  
        $book->ISBN = $request->get('ISBN');  
        $book->annotation = $request->get('annotation'); 
        $book->withraw = $request->get('withraw');           
        $book->save();  
        return redirect()->route('books.index')
        ->with('success','Статистический сборник добавлен.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::find($id);
        return view('books.edit',compact('book'));
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
        $book = new Book();  
        $book->name =  $request->get('name');  
        $book->additionalname = $request->get('additionalname');  
        $book->response = $request->get('response');  
        $book->additionalresponse = $request->get('additionalresponse');  
        $book->publishplace = $request->get('publishplace'); 
        $book->publishhouse = $request->get('publishhouse'); 
        $book->publishyear = $request->get('publishyear'); 
        $book->tom = $request->get('tom'); 
        $book->pages = $request->get('pages');
        $book->authorsign = $request->get('authorsign');   
        $book->code = $request->get('code');
        $book->numbersk = $request->get('numbersk');        
        $book->recieptdate = $request->get('recieptdate'); 
        $book->rubric_id = $request->get('rubric'); 
        $book->cost = $request->get('cost');  
        $book->ISBN = $request->get('ISBN');  
        $book->annotation = $request->get('annotation'); 
        $book->withraw = $request->get('withraw');           
        $book->save();  
        return redirect()->route('books.index')
        ->with('success','Статистический сборник обновлен.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book=Book::find($id);  
        $book->delete();  
        return redirect()->route('books.index')
        ->with('success','Статистический сборник .');
    }

    /*public function search(Request $request)    
    {
        $search = $request->input('search');
        $books  = Book ::join('book_author','book.id','=','book_author.book_id')
         ->join('author','author.id','=','book_author.author_id') 
         ->join('rubric','rubric.id','=','book.rubric_id') 
         ->leftjoin('files','files.id','=','book.file_id') 
         ->where("author.surname", "like", "{$search}". "%")
         ->orWhere("book.name", "like", "%"."{$search}". "%")
         ->groupBy('book_author.book_id')
         ->select('book.id','book.name','book.publishplace','book.publishyear','book.pages','rubric.title','author.surname','files.filepath','files.filename') 
         ->paginate(10); 
         $books->appends(['search' => $search]);       
         return view('search', compact('books'));                        
    }*/
}
