<?php

class BudgetPurchase
extends Eloquent
{
    protected $table = "major_purchases";
    protected $primaryKey = 'mp_id';
    public $timestamps = false;

    protected $fillable = [
		'mp_bpid',
		'mp_name',
		'mp_price',
		'mp_date',
		'mp_depreciate'
	];

    public function businessPlan()
    {
        return BusinessPlan::find($this->mp_bpid);
    }

    public static function getAll($id) 
    {
         $data = DB::table('major_purchases')
                ->where('mp_bpid', $id)
                ->get();

         return $data ? $data : [];
    }
}