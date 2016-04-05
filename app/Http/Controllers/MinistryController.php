<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Ministry as Ministry;
use App\Relation as Relation;

class MinistryController extends Controller
{

	
    public function index(){
    	$ministries = [];
        $relations = Relation::where('level', 1)->get();
        foreach ($relations as $relation) {
            $ministries[] = Ministry::find($relation->ministry_id);
        }
        session()->forget('parent_id');
    	return view('ministries.index', array('ministries' => $ministries));
    }

    public function show($id){
    	$ministry = Ministry::find($id);
    	if($ministry->has_child == 0){
    		return view('ministries.show', array( 'ministry' => $ministry ));
       	} else {
       		return view('ministries.categories.show', array( 'ministry' => $ministry));
       	}
    }

    /* public function create(){
    	return view('ministries.firstScreen');
    } */

    /* public function store(Request $request){

    	$inputs = $request->all();
    	$ministry = Ministry::create($inputs);
    	return redirect()->route('ministries.index');

    } */

    public function edit($id){

    	$ministry = Ministry::find($id);
    	return view('ministries.edit')->with('ministry', $ministry);

    }

    public function destroy($id){

        $ministry = Ministry::find($id);
        $ministry->parentMinistries()->detach();
    	Ministry::destroy($id);

    	return redirect()->route('ministries.index');

    }

    public function update(Request $request, $id){

    	$ministry = Ministry::find($id);

    	$ministry->title = $request->title;
    	$ministry->save();

    	return redirect()->route('ministries.index');

    }

    public function getFirst(){
        return view('ministries.firstForm');
    }

    public function postFirst(Request $request){
        
    	$title = $request->input('title');
    	$selected = $request->input('option');
    	
    	$ministry = new Ministry;
        $ministry->title = $title;

        $ministry->save();

    	
    	$request->session()->put('ministry', $ministry);

    	if($selected == 'ministry') {
    	
    		return redirect()->action('MinistryController@getMinistryForm');	
    	
    	} elseif ($selected == 'category') {
    	
    		return redirect()->action('MinistryController@category');
    	
    	} else {
    	
    		return redirect()->action('MinistryController@getFirst');
    	
    	}
    	
    }

    public function getMinistryForm(Request $request){
    	return view('ministries.ministryForm')
    				->with('ministry', $request->session()->get('ministry'));
    }

    public function postMinistryForm(Request $request){
    	$ministry = $request->session()->get('ministry');
        $ministry->update($request->all());
        $ministry->update([
            'has_child' => 0
        ]);
        
        if($p_id = session()->pull('parent_id')){
            $ministry->parentMinistries()->attach($p_id, 
                                                  ['level' => (Relation::where('ministry_id', $p_id)->get()->first()->level + 1)]); 

        } else { 
            $ministry->parentMinistries()->attach(0, ['level' => 1]);  
        }
    	return redirect()->route('ministries.index');
        
    }

    public function category(Request $request){
        $ministry = $request->session()->get('ministry');
        $ministry->update([
            'has_child' =>  1
        ]);
        if($p_id = session()->pull('parent_id')){
            $ministry->parentMinistries()->attach($p_id, 
                                                  ['level' => (Relation::where('ministry_id', $p_id)->get()->first()->level + 1)]); 

        } else { 
            $ministry->parentMinistries()->attach(0, ['level' => 1]);  
        }
        return view('ministries.categories.show')->with('ministry', $ministry);
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
