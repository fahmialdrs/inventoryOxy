<?php 
/**
 * Created By Arief Hikam
 * https://github.com/ariefhikam
 */
namespace App\CostumsClass;

use Illuminate\Database\Query\Expression;

trait ModelTrait {

	public function scopeModelJoin($query, $relation_name, $operator = '=', $type = 'left', $where = false) {
        $split = explode('.', $relation_name);
        $relation = $this->{$split[0]}();
        $related_column = $split[1];
        $table = $relation->getRelated()->getTable();
        $tableModel = $this->getTable();
        if(class_basename($relation) == 'HasOne'){
            $one = $relation->getParent()->table.'.'.$relation->getParent()->primaryKey;
        }else{
            $one = $table.'.'.$relation->getRelated()->primaryKey;
        }
        $two = $tableModel.'.'.$relation->getForeignKey();
        
        /**
         * perlu dininget kalo pake postgres query gak bisa pake ` 
         */
        if (empty($query->columns)) {
            $query->select(new Expression("$tableModel.*"));
        }

        // foreach (\Schema::getColumnListing($table) as $related_column) {
            $query->addSelect(new Expression("$table.$related_column AS $split[0]_$related_column"));
        // }
        return $query->join($table, $one, $operator, $two, $type, $where);
    }

    public function getPrimaryKey(){
        return $this->primaryKey;
    }

    /**
     * tambah global scope biar id != 0
     * @return [type] [description]
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new IdScope);
    }
}

