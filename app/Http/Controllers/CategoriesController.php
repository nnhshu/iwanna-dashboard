<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CategoriesRequest;
use Illuminate\Support\Facades\Validator;
use App\Models\Categories;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Categories::all();
        return view('categories.index')->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoriesRequest $request)
    {
        $result = Categories::create([
            'title' => $request->title,
            'description' => $request->description
        ]);

        if ($result) {
            $categories = Categories::all();
            return view('categories.index', compact('categories'))->with('msg', 'Thêm thành công danh mục');
        }

        Session::flash('error', trans('Thêm thất bại !'));

        return response()->json([
            'status' => false,
        ]);

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
        $model = Categories::find($id);
        if(!$model){
            return redirect()->route('categories.index');
        }

        $cates = Categories::all();
        return view('categories.edit', compact('model', 'cates'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoriesRequest $request, $id)
    {
        $result = Categories::whereId($id)->update( $request->except('_method', '_token') );
        if ($result) {
            $categories = Categories::all();
            return view('categories.index', compact('categories'))->with('msg', 'Cập nhật thành công danh mục');
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
        $result = Categories::find($id);
        $result->delete();
        if ($result) {
            $categories = Categories::all();
            return view('categories.index', compact('categories'))->with('msg', 'Xoá thành công danh mục');
        }
    }
}
