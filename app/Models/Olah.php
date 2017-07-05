<?php 
/**
 * Otomatis Olah Query dari request.
 * search, skip, take, paginate, sort, sortType
 * 
 * Created By Arief Hikam
 * https://github.com/ariefhikam
 */
namespace App\Models;

use Illuminate\Database\Query\Expression;
use Illuminate\Http\Request;
use  Illuminate\Database\Eloquent\Builder;

Class Olah{

    protected $table;
    protected $request;
    public $searchQuery;
    public $anotherQuery;

    /**
     * define Table Query Builder dan Request
     * @param Builder $table [Model table]
     */
    public function __construct(Builder $table){

        $this->table = $table;
        $this->request = request();
    }

    public $blacklist = ['search','sort','sortType','take','skip','paginate','response','page'];
    /*
        Param:
            $request :  object request
            $search : Closure untuk costum field mana aja yang mau di search
            $another : Clusure untuk costum query yang pengen di pake.

     */
	public function ambil() {
        $table = $this->table;
        $request = $this->request;

        /*
            body request yang di blacklist gak bakal masuk ke pencarian
         */
        $blacklist = $this->blacklist;
        /*
            Ambil semua request
         */
        $inputs = $request->all();

        /*
            search berdasarkan nama body request dan valuenya
            hot to use :

            index?id=1
            -bakal nampilin record column yang `id` sama dengan 1

            index?category_id=1&status=complete 
            -bakal nampilin `category_id` = 1 DAN `status` = `complete`
         */
        $table->where(function($q) use($inputs,$blacklist){
            foreach ($inputs as $input => $inputVal) {
                /*
                    cegah body request yang blacklist gak masuk ke pencarian
                 */
                if (!in_array($input, $blacklist)) {
                    $q->where($input,$inputVal);
                }
            }
        });
        /*
            Search
            method name : search
         */
        if(isset($request->search)){
            $search = $this->searchQuery;
            $table->where(function($q) use($search){
               call_user_func($search,$q);
            });
        }
        
        /*
            Sort
            pake query scope modelJoin biar bisa sorting ke tabel lain.
         */
        if(isset($request->sort) && isset($request->sortType)){
            if(str_contains($request->sort,'.')){
                $split = explode('.', $request->sort);
                /**
                 * handle buat ambigius column
                 */
                if($table->getModel()->getTable() == $split[0]){
                    $table->orderBy($request->sort,$request->sortType);
                }else{
                    $table->modelJoin($request->sort);
                    $table->orderBy($split[0]."_".$split[1],$request->sortType);
                }                
            }else{
                $table->orderBy($table->getModel()->getTable().'.'.$request->sort,$request->sortType);
            }
        }else{
            /**
             * Defaul Sort
             * kadang ada table yang gak pake created_at
             * jadi desc dari primary keynya
             */
            // dd($table->getModel()->getPrimaryKey());
            if($table->getModel()->timestamps){
                $table->orderBy($table->getModel()->getTable().'.created_at','DESC');
            }else{
                $table->orderBy($table->getModel()->getTable().'.'.$table->getModel()->getPrimaryKey(),'DESC');
            }       

        }

        /*
            Another
            Closure untuk kondisi atau kostum query
         */
        if (isset($this->anotherQuery)) {
             call_user_func($this->anotherQuery,$table);
        }

        /*
            Take
            limit buat ambil record di query
         */
        if(isset($request->take) || $request->take != ''){
            $table->take($request->take);
        }

        /*
            Skip
            Skip beberapa record di query
         */
        if(isset($request->skip) || $request->skip != ''){
            $table->skip($request->skip);
        }        

        /*
            pengkondisian untuk paginate atau ambil semua atau ambil satu object aja
         */
        if (isset($request->paginate) && $request->paginate == '0') {
            $table = $table->get();
        }
        else if(isset($request->take) && $request->take == '1'){
            $table = $table->first();
        }
        else{
            $table = $table->paginate(15);
        }

        return $table;        
    }   

    /**
     * Closure untuk costum search query
     * @param  [function] $query costum query, bakal manggil query builder
     */
    public function search($query){
        $this->searchQuery = $query;
    }  

    /**
     * Closure untuk costum query
     * @param  [function] $query costum query, bakal manggil query builder
     */
    public function another($query){
        $this->anotherQuery = $query;
    } 

    /**
     * Ambil semua request yang di olah
     * @return [array] [balikin array request input]
     */
    public function getAllRequest(){
        return $this->request->all();
    }
}

