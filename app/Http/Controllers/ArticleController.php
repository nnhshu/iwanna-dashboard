<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ArticlesRequest;
use App\Models\Article;
use App\Models\Categories;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $articles = Article::all();

        return view( 'article.index',compact('articles') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categories::all();
        return view( 'article.create', compact('categories') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticlesRequest $request)
    {
        
        if($request->hasFile('avatar') ){
           
            //save avatar
            $oriFileName = $request->avatar->getClientOriginalName();
            $filename = str_replace(' ', '-', $oriFileName);
            $filename = uniqid() . '-' . $filename;
            $path = $request->file('avatar')->storeAs('public/posts', $filename);
            $pathFile = "storage/posts/".$filename;

        }

        if( $request->status == '' ){
            $status = '1';
        }
        $slug = str_slug($request->title);
        $result = Article::create([
            'title' => $request->title,
            'avatar' => $pathFile ? $pathFile : '',
            'slug' => $slug,
            'categories_id ' => $request->categories_id,
            'short_desc' => $request->short_desc,
            'content' => $request->content,
            'status' => $request->status
        ]);

        if ($result) {
            $articles = Article::all();
            return view('article.index', compact('articles'))->with('msg', 'Thêm thành công bài viết');
        }
        
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
        $model = Article::find($id);
        if(!$model){
            return redirect()->route('article.index');
        }

        $cates = Categories::all();
        return view('article.edit', compact('model', 'cates'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticlesRequest $request, $id)
    {

        if($request->hasFile('image') != ''){
            $oriFileName = $request->avatar->getClientOriginalName();
            $filename = str_replace(' ', '-', $oriFileName);
            $filename = uniqid() . '-' . $filename;
            $path = $request->file('avatar')->storeAs('public/posts', $filename);
            $pathFile = "storage/posts/".$filename;
            $result = Article::where('id', $request->id ) -> update([
                'avatar' => $pathFile ? $pathFile : ''
            ]);
        }
        if( $request->status == '' ){
            $status = '1';
        }
        echo $request->status;
        $slug = str_slug($request->title);
        $result = Article::where('id', $request->id ) -> update([
            'title' => $request->title,
            'slug' => $slug,
            'categories_id ' => $request->categories_id,
            'short_desc' => $request->short_desc,
            'content' => $request->content,
            'status' => $request->status
        ]);

        if ($result) {
            return redirect(route('article.index'));
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try{
            $result = Article::find($id);
			if($result){
				$result->delete();
				DB::commit();
			}
    	}catch(Exception $ex){
    		DB::rollback();
    	}

        $articles = Article::all();
        return redirect()->route('article.index')->with('msg', 'Xoá thành công');;
    }
}
