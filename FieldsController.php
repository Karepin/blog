<?php 		
namespace App\Http\Controllers;

use Illuminate\Http\Request as Request;
use App\Http\Controllers\Controller as Controller;
use App\Field as Field;

class FieldsController extends Controller
{
	public function index(){
		$field=Field::orderBy('id','asc')->first();
		if(is_null($field)){
			$field = Field::create([]);
		}
		return redirect('/fields/'.Field::$language.'/'.$field->id);
		//return view('fields',['field'=>$field]);
	}
	public function single($lang, $id){
		$field=Field::findOrFail($id);
		//var_dump($field);
		$maxid=Field::max('id');
		//var_dump($maxid);
		Field::setLocale($lang);
		return view('fields',['field'=>$field,'mid'=>$maxid]);
	}
	public function single_post(Request $request, $lang, $id){

		if($request->input('action')=='Language'){
			if($lang == $request->input('Language')) 
				 $l = $request->input('strnew');
			else $l = $request->input('Language');
			Field::setLocale($l);
			return redirect('/fields/'.Field::$language.'/'.$id);
			}

		Field::setLocale($lang);
			
		if($request->input('action')=='Create'){
			$field = Field::create([]);
			return redirect('/fields/'.Field::$language.'/'.$field->id);
			}
		if($request->input('action')=='Decrease'){
			$field=Field::where('id','<', $id)->orderBy('id','desc')->first();
			if(is_null($field)) return redirect('/fields/'.Field::$language.'/'.$id);
			return redirect('/fields/'.Field::$language.'/'.$field->id);
			}
		if($request->input('action')=='Increase'){
			$field=Field::where('id','>', $id)->orderBy('id','asc')->first();
			if(is_null($field)) return redirect('/fields/'.Field::$language.'/'.$id);
			return redirect('/fields/'.Field::$language.'/'.$field->id);
			}
		if($request->input('action')=='Delete'){
			$affectedRows = Field::where('id', $id)->update([Field::$language => '']);
			return redirect('/fields/'.Field::$language.'/'.$id);
			}
		if($request->input('action')=='Edit'){
			$affectedRows = Field::where('id', $id)->update([Field::$language => $request->input('strnew')]);
			return redirect('/fields/'.Field::$language.'/'.$id);
			}
	}
}

