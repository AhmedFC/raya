<?php

namespace App\Repositories\Eloquent;

use App\Interfaces\Eloquent\MainEloquent;
use Exception;
use Illuminate\Database\Eloquent\Model;

class Repository implements MainEloquent{

    var $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getAll($with = false)
    {
        return ($with) ? $this->model->with($with)->orderBy('created_at','desc')->get() : $this->model->orderBy('created_at','desc')->get();
    }
    public function getAllSpisficData($with = false , $selectedData = [], $order = 'created_at')
    {

        return ($with) ? $this->model->with($with)->orderBy($order,'desc')->get($selectedData) : $this->model->orderBy($order ,'desc')->get($selectedData);
    }
    public function getALLOrderedBy($attr,$dir)
    {
         return $this->model->orderBy($attr,$dir)->get();
    }

    public function getById($id, $with = false)
    {
        return ($with) ? $this->model->where('id', $id)->with($with)->first() : $this->model->where('id', $id)->first();
    }

    public function getBy($AttributeName, $AttributeValue)
    {
        return $this->model->where($AttributeName, $AttributeValue)->get();
    }
    public function getByApi($AttributeName, $AttributeValue)
    {
        return $this->model->where($AttributeName, $AttributeValue)->first();
    }
    public function getByIds($ids)
    {
        return $this->model->whereIn('id', $ids)->get();
    }

    public function save($inputs, $getId = false)
    {

        try{
            return ($getId) ? $this->model->insertGetId($inputs) : $this->model->create($inputs) ;
        }catch (\Exception $e){
           return $e;
        }

    }

    public function saveBulk($inputs)
    {
        return $this->model->insert($inputs) ;
    }

    public function update($inputs, $id){
        unset($inputs['id']);
        return $this->model->where('id', $id)->update($inputs);
    }

    public function updateBulk($inputs, $ids)
    {
        return $this->model->whereIn('id', $ids)->update($inputs);
    }


    public function delete($id)
    {
        return $this->model->where('id', $id)->delete();
    }

    public function search($request)
    {
        try{
            $inputs = $request->input();
            $result = $this->model->query();
            $result->when(!empty($inputs['fromDate']) && empty($inputs['toDate']), function ($q) use($inputs) {
                return $q->whereDate('created_at', '>=', $inputs['fromDate']);

             });
            $result->when(empty($inputs['fromDate']) && !empty($inputs['toDate']), function ($q) use($inputs) {
                return  $q->whereDate('created_at', '<=', $inputs['toDate']);
             });
            $result->when(!empty($inputs['fromDate']) && !empty($inputs['toDate']), function ($q) use($inputs) {
                return $q->whereBetween('created_at', [$inputs['fromDate'], $inputs['toDate']]);

             });
            return  $result->orderBy('id', 'DESC')->get();
        }catch(Exception $ex){
            return false;
        }

    }


}
