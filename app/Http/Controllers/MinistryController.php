<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Ministry as Ministry;
use App\Relation as Relation;

class MinistryController extends Controller
{

	
    public function index()
    {
        $relations = Relation::where('level', 1)->get();
        $ministries = [];
        foreach ($relations as $relation) {
            $ministries[] = Ministry::find($relation->ministry_id);
        }
        return view('ministries.index')->with('ministries', $ministries);
    }

    public function show($id)
    {
        $ministry = Ministry::find($id);
        if($ministry->has_child == 0){
            return view('ministries.show')->with('ministry', $ministry);
        } else {
            return view('ministries.categories.show')->with('ministry',$ministry);
        }
    }

    public function edit($id)
    {
        $ministry = Ministry::find($id);
        return view('ministries.edit')->with('ministry', $ministry);
    }

    public function update(Request $request, $id)
    {
        $inputs = $request->all();
        
        $ministry = Ministry::find($id);
        $ministry->update($inputs);

        return redirect()->route('ministries.show', $ministry->id);
    }

    public function destroy($id)
    {
        $ministry = Ministry::find($id);
        $ministry->parentMinistries()->detach();
        
        Ministry::destroy($id);

        return redirect()->route('ministries.index');

    }

    public function getFirst()
    {
        return view('ministries.firstForm');
    }

    public function postFirst(Request $request)
    {
         
        $option = $request->input('option');
        
        /*$ministry = new Ministry;
        $ministry->title = $request->input('title');
        $ministry->image_link = $request->input('image_link');

        $ministry->save();*/

        $data['title'] = $request->input('title');
        $data['image_link'] = $request->input('image_link');


        if($option == 'ministry') {
            if($request->has('parent_id')){
                return view('ministries.ministryForm',['parent_id' => $request->input('parent_id'),
                                                        'title' => $data['title'],
                                                        'image_link' => $data['image_link']]);
            }
            return view('ministries.ministryForm', ['title' => $data['title'],
                                                        'image_link' => $data['image_link']]);
        
        } elseif($option == 'category') {
            $request->session()->put('data', $data);
            return redirect()->action('MinistryController@category')->withInput();
        
        }
    
    }

    public function getMinistryForm()
    {
        return view('ministries.ministryForm');
    }

    public function postMinistryForm(Request $request)
    {   
        
        $ministry = Ministry::create([
            'title'  => $request->input('title'),
            'image_link' => $request->input('image_link'),
            'detail' => $request->input('detail'),
            'phone' => $request->input('phone'),
            'function' => $request->input('function'),
            'nagarik_badapatra' => $request->input('nagarik_badapatra'),
            'website' => $request->input('website'),
            'has_child' => 0
        ]);
        if($request->has('parent_id')){
            $p_id = $request->input('parent_id');
            $level = Relation::where('ministry_id', $p_id)->get()->first()->level;
            $ministry->parentMinistries()
                     ->attach($p_id, ['level' => ( $level + 1)]);
        } else { 
            $ministry->parentMinistries()->attach(0, ['level' => 1]);  
        }
        return redirect()->route('ministries.index');
    }

    public function newCategory($id)
    {
        
        return view('ministries.firstForm')->with('parent_id', $id);
    }

    public function category(Request $request){
        $data = $request->session()->pull('data');
        $ministry = Ministry::create([
            'title' => $data['title'],
            'image_link' => $data['image_link'],
            'has_child' =>  1
        ]);
        if($request->session()->has('parent_id')){
            $p_id = $request->session()->pull('parent_id');
            $level = Relation::where('ministry_id', $p_id)->get()->first()->level;
            $ministry->parentMinistries()
                     ->attach($p_id, ['level' => ( $level + 1)]);
        } else { 
            $ministry->parentMinistries()->attach(0, ['level' => 1]);  
        }
        return redirect()->route('ministries.show', $ministry->id);
    }
























































    public function apiAll(){
        $ministries = [];
        $relations = Relation::where('level', 1)->get();
        foreach ($relations as $relation) {
            $ministries[] = Ministry::find($relation->ministry_id);
        }
        return $ministries;
    }

    public function apiMinistry($id){
        
        $ministry = Ministry::find($id);
        $data = $ministry->toArray();
        $data['children'] = $ministry->subMinistries()->pluck('ministry_id');
        $data['parent'] = $ministry->parent->id;
        return $data;
    }

}
