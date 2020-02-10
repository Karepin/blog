<?php	

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Field extends Model
{
	public static $firstlang = "ru";
	public static $language = "ru";
	public static $dbfields=[];
    public $timestamps = false;
    //
	
	public static function getFields(){
		if(empty(static::$dbfields)){	
			static::$dbfields = Schema::getColumnListing('fields');
			array_shift(static::$dbfields);
			}
		return static::$dbfields;
	}
	
	public static function setLocale($lng) {
		if(static::$language === $lng) return;
		static::$language = $lng;
		if( Schema::hasColumn('fields', static::$language) ) return;
		Schema::table('fields', function (Blueprint $table) {
			$table->string(static::$language, 255);
		});
		array_push ( static::$tablefields, static::$language );
	}


}
