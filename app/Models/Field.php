<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
        'points' => 'array'
    ];

    public function cultivations()
    {
        return $this->hasMany(Cultivation::class);
    } 
    public function parent()
	{
    	return $this->hasOne(Field::class, 'id', 'parent_id');
	}

	public function children()
	{
	   	return $this->hasMany(Field::class, 'parent_id', 'id');
	}

    public function actual_cultivation() 
    {
        $cult = Cultivation::where('field_id',$this->id)->get()->first();
        return $cult ;
    }
    public static function treeAll(){
		//$arr_categories =  array('name' => 'id');
		//$collection = collect([1, 2, 3]);	
		$primField = static::where('parent_id', '=', 0)->get();
		$fields = collect(new Field);
		//$arr_Fieldegories = collect($categories);
		foreach ( $primField as $fieldFather){
			$fields->push($fieldFather);
			//$child_categories = collect());
			$fields = $fields->merge(static::getAllChild($fieldFather, ''));	
		}
		//dd($categories);
		$fields = $fields->pluck('name','id');
		return $fields->all();
	}
    public static function getAllChild(Field $field, string $pre){
		$fieldChilds = collect(new Field);
		$pre .= " -> ";
		if ($field->children->count() > 0)	{	
			foreach($field->children as $field_child){
				//$arr_categories->push([' - '.$field_child->name => $field_child->id]);
				$field_child->name = $pre.$field_child->name;
				$fieldChilds->push($field_child);
				if ($field_child->children->count() > 0)	{	
					$fieldChilds = $fieldChilds->merge(static::getAllChild($field_child, $pre));
				}
			}
		}
		//dd($fieldChilds);
		return $fieldChilds;
	}
	public function operations()
    {
        return $this->hasMany(Operation::class);
    }
}
