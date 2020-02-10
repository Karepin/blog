
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
<form method="post">
{{ csrf_field() }} 
<table class="table" width="500" border="1" align="center" cellpadding="4" >
			<tr><th colspan="7" ><h2>Field admin<h2></th></tr>
			<tr><th>ID</th><th>{{$field->id}}</th><th>from</th><th>{{$mid}}</th><th>Language:</th><th>
				<select name = "Language">
					@foreach(\App\Field::getFields() as $fld)
						<option {{ ($fld == \App\Field::$language ? 'selected' : '' ) }} value="{{$fld}}">{{$fld}}</option>
					@endforeach
				</select></th></tr>
			<tr><th>String {{\App\Field::$firstlang}}</th><th colspan="6" >{{$field->{\App\Field::$firstlang} }}</th></tr>
			<tr><th>String {{\App\Field::$language}}</th><th colspan="6" ><input type = "text"  name = "strnew" value =  "{{$field->{\App\Field::$language} }}"></th></tr>
			<tr><th><button type="submit" name = "action" value="Language">Language</button></th>
				<th><button type="submit" name = "action" value="Edit">Edit</button></th>
				<th><button type="submit" name = "action" value="Delete">Delete</button></th>
				<th><button type="submit" name = "action" value="Create">Create</button></th>
				<th><button type="submit" name = "action" value="Decrease"> - 1 </button></th>
				<th><button type="submit" name = "action" value="Increase"> + 1 </button></th></tr>
</table></form>           
            </div>
        </div>
    </div>
</div>
