<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\product;
use App\Models\section;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $products = product::all() ;
            $sections = section::select('id' , 'section_name')->get() ;

            // return $sections ;
            return view('product.index')->with('products' , $products)->with('sections' , $sections) ;

        } catch (\Exception $ex) {
            return redirect()->route('invoices.index') ;
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        try {

            if (isset($request->section_id) && filter_var($request->section_id , FILTER_VALIDATE_INT)) {

                $section = section::find($request->section_id) ;

                if($section)    {
                    product::create($request->all()) ;
                    session()->flash('sucssfily' ,'تم إضافه المنتج بنجاح') ;

                    return redirect()->back() ;
                }

            }

            return redirect()->route('invoices.index') ;

        } catch (\Exception $ex) {
            return redirect()->route('invoices.index') ;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(product $product)
    {
        //
    }
}
