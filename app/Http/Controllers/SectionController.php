<?php

namespace App\Http\Controllers;

use App\Http\Requests\sectionRequest;
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
    public function update(Request $request, section $section)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(section $section)
    {
        //
    }
}
