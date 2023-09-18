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
    public function update(ProductRequest $request)
    {
        try {
            $section = section::where('section_name' , $request->section_id)->first() ;
            $product = product::where('id' , $request->id)->first() ;

            if($section && $product)    {

                $product->name          = $request->name ;
                $product->description   = $request->description ;
                $product->section_id    =  $section->id ;

                $product->save() ;

                session()->flash('update' , 'تم تحديث المنتج بنجاح') ;

                return redirect()->back() ;

            }   else    {
                return redirect()->route('invoices.index') ;
            }
        } catch (\Exception $ex) {
            return redirect()->route('invoices.index') ;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $product = product::where('id' , $request->id)->first() ;

            if ($product)   {

                $product->delete() ;

                session()->flash('delete' , 'تم حذف المنتج بنجاح') ;

            }
            return redirect()->back() ;

        } catch (\Exception $ex) {
            return redirect()->route('invoices.index') ;
        }
    }
}
