<?php

namespace App\Http\Controllers;

use App\Http\Requests\sectionRequest;
use App\Models\product;
use App\Models\section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $sections = section::all() ;

            return view('section.index')->with('sections' , $sections) ;

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
    public function store(sectionRequest $request)
    {
        $request['created_by']  =  Auth::id() ;

        section::create($request->all()) ;

        session()->flash('sucssfily' , 'تمت اضافه القسم بنجاح') ;

        return redirect()->back() ;
    }

    /**
     * Display the specified resource.
     */
    public function show(section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(sectionRequest $request, section $section)
    {
        try {
            if( isset($request) && filter_var($request->id , FILTER_VALIDATE_INT) ) {
                $section = section::find($request->id) ;

                if($section)    {
                    $section->section_name = $request->section_name ;
                    $section->description  = $request->description ;

                    $section->save() ;

                    session()->flash('update_sucssfily' , 'تمت تحديث القسم بنجاح') ;
                }

                return redirect()->back() ;
            }   else    {
                return redirect()->route('section.index') ;
            }
        } catch (\Exception $ex) {
            return redirect()->route('section.index') ;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            if( isset($request->id) && filter_var($request->id , FILTER_VALIDATE_INT) ) {

                $section = section::find($request->id) ;

                if($section)    {

                    $id = $section->id ;

                    // Bring all the products in the section
                    $product = product::select('id')->where('section_id' , $id)->get() ;

                    // Delete all products in the section
                    product::destroy($product->toArray()) ;

                    $section->delete() ;
                    session()->flash('delete_sucssfily' , 'تم حذف القسم بنجاح') ;
                }
                return redirect()->back() ;

            }   else    {
                return redirect()->route('section.index') ;
            }
        } catch (\Exception $ex) {
            return redirect()->route('section.index') ;
        }
    }
}
