<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Qualification;

use App\Http\Requests\StoreQualificationRequest;
use App\Http\Requests\UpdateQualificationRequest; 

class QualificationsController extends Controller
{
    public function index()
    {
        $qualifications = Qualification::all();
        return view('qualifications.index', ['qualifications' => $qualifications]);
    }

    public function create()
    {
        return view('qualifications.create');
    }

    public function store(Qualification $qualification, StoreQualificationRequest $request) 
    {
        $input = $request->all();      
        $qualification = Qualification::create($input); 
        $request->session()->flash('success', 'Qualification saved successfully!');
        return redirect()->route('qualifications.index'); 
    }
  
    public function show(Qualification $qualification)
    {
        //
    }

    public function edit(Qualification $qualification)
    {
        return view('qualifications.edit', ['qualification' => $qualification]);
    }

    public function update(Qualification $qualification, UpdateQualificationRequest $request) 
    {
        $qualification->update($request->all());
        $request->session()->flash('success', 'Qualification updated successfully!');
        return redirect()->route('qualifications.index');
    }
  
    public function destroy(Request $request, Qualification $qualification)
    {
        $qualification->delete();
        $request->session()->flash('success', 'Qualification deleted successfully!');
        return redirect()->route('qualifications.index');
    }
}
