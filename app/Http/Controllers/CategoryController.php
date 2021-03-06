<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

use Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        if (Auth::user()->hasPermissionTo('crud categories')) {
            $categories = Category::all();
            return view('categories.index', compact('categories'));
        }else {
            return redirect()->back()->with('error','No tiene los permisos necesarios');
        }    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::user()->hasPermissionTo('crud categories')) {

            if ($category = Category::create($request->all())) {
                return redirect()->back()->with('status','La categoría se creó con éxito');
            }
            return redirect()->back()->with('error','No se pudo crear la categoría');

        }else {
            return redirect()->back()->with('error','No tiene los permisos necesarios');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if (Auth::user()->hasPermissionTo('crud categories')) {

            $category= Category::find($request->id);

            if($category)
            {
                if($category->update($request->all())) 
                {
                    return redirect()->back()->with('status','La categoría se modificó con éxito');
                }
            }
            return redirect()->back()->with('error','No se pudo editar la categoría');

        }else {
            return redirect()->back()->with('error','No tiene los permisos necesarios');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if (Auth::user()->hasPermissionTo('crud categories')) {
          
            if ($category->delete())
            {
                return response()->json([

                    'message' => 'Categoría eliminada con éxito',
                    'code' => '200'
                ]);
            }
            return response()->json([
                'message' => 'No se ha podido eliminar la categoría',
                'code' => '400'
            ]);

        }else {
            return redirect()->back()->with('error','No tiene los permisos necesarios');
        }
    }
}
