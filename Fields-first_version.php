<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Field extends Model
{
	public static $firstlang = "ru";
	public static $language = "ru";
	public static $tableName = "fields";
	public static $tablefields;

	public function __construct() {
		static::$tablefields = Schema::getColumnListing(static::$tableName);
		if( is_array(static::$tablefields) ) return;
		Schema::create(static::$tableName, function (Blueprint $table) {
			$table->increments('id');
			$table->string(static::$firstlang, 255);
		});
	}
	
	public static function setLocale($lng) {
		if(static::$language === $lng) return;
		static::$language = $lng;
		if( Schema::hasColumn(static::$tableName, static::$language) ) return;
		Schema::table(static::$tableName, function (Blueprint $table) {
			$table->string(static::$language);
		});
		array_push ( static::$tablefields, static::$language );
	}
	//Field::find($id);
	public static function find($num) {
		return DB::table(static::$tableName)->where('id', $num)->value(static::$language);
	}

	public static function getList($list) {
		return DB::table(static::$tableName)->whereIn('id', $list)->->lists(static::$language);
	}

	public static function create($data) {
		return DB::table(static::$tableName)->insertGetId([ static::$language => $data['value'] ] );
	}
	
	public static function update($num, $data) {
		return DB::table(static::$tableName)->where('id', $num)->update([ static::$language => $data['value'] ]);
	}

	public static function delete($num) {
		return DB::table(static::$tableName)->where('id', $num)->update([ static::$language => '' ]);
	}

	public static function get2row($num) {
		$data = DB::table(static::$tableName)->select(static::$firstlang, static::$language)
			->where('id', $num)->first();
		$maxId = DB::table(static::$tableName)->max('id');
		array_push ( $data, [ 'maxId' => $maxId ] );
		array_push ( $data, [ 'language' => static::$language ] );
		return view('fields', $data);
	}
	
}

