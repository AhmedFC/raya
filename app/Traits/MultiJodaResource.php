<?php

namespace App\Traits;

use Carbon\Carbon;
use LogicException;
use App\Models\Booking;

trait MultiJodaResource
{
    use ResourceHelpers;


    public function index()
    {
        ${$this->pluralCamelName} = $this->getQuery();

        $index = ${$this->pluralCamelName};
        $route = $this->route;
        $title = trans(ucfirst($this->pluralCamelName));
        // dd(compact($this->pluralCamelName, 'index', 'route', 'title'));
        return view("{$this->view}.index", compact($this->pluralCamelName, 'index', 'route', 'title'));
    }


    public function create()
    {
        $route = $this->route;
        $title = trans('Create ' . ucfirst($this->singularCamelName));
        ${$this->singularCamelName} = null;
        $addData = $this->createData();
        return view("{$this->view}.create", array_merge(compact('route', 'title', $this->singularCamelName), $addData));
    }


    public function store()
    {
        $returned = $this->beforeStore();
        if ($returned) {
            return $returned;
        }

        $data = $this->validateStoreRequest();


        $data = $this->uploadFilesIfExist($data);
        $data['end_date'] = date("Y-m-d", strtotime('+1 ' , strtotime($data['start_date'])));
        $createdModel = $this->model::create($data);
        $returned = $this->afterStore($createdModel);
        if ($returned) {
            return $returned;
        }

        return $this->stored();
    }


    public function show($id)
    {
        ${$this->singularCamelName} = $this->model::find($id);
        $show = $this->model::find($id);
        $title = trans('Show ' . ucfirst($this->singularCamelName));
        return view("$this->view.show", compact($this->singularCamelName, 'show', 'title'));
    }


    public function edit($id)
    {
        ${$this->singularCamelName} = $this->model::find($id);
        $edit = $this->model::find($id);
        $route = $this->route;
        $title = trans('Edit ' . ucfirst($this->singularCamelName));
        $addData = $this->editData();
        // dd(compact($this->singularCamelName, 'edit', 'route', 'title'));
        return view("$this->view.edit", array_merge(compact($this->singularCamelName, 'edit', 'route', 'title'), $addData));
    }


    public function update($id)
    {
        $model = $this->model::find($id);
        $returned = $this->beforeUpdate($model);
        if ($returned) {
            return $returned;
        }

        $data = $this->validateUpdateRequest();

        $data = $this->uploadFilesIfExist($data);
        $updatedModel = tap($model)->update($data);

        $returned = $this->afterUpdate($updatedModel);
        if ($returned) {
            return $returned;
        }

        return $this->updated();
    }


    public function destroy($id)
    {
        $model = $this->model::find($id);

        $returned = $this->beforeDestroy($model);
        if ($returned) {
            return $returned;
        }

        $this->deleteFilesIfExist($model);
        $model->delete();

        $returned = $this->afterDestroy();
        if ($returned) {
            return $returned;
        }

        return $this->destroyed();
    }

    public function validateStoreRequest()
    {
        $rules = $this->storeRules();
        if ($rules) {
            return request()->validate($rules);
        } else {
            throw new LogicException('there are no rules in ' . get_class($this) . ' for store validation please set $storeRules property or $rules for both store and update in either the controller or the model');
        }
    }

    public function validateUpdateRequest()
    {
        $rules = $this->updateRules();
        if ($rules) {
            return request()->validate($rules);
        } else {
            throw new LogicException('there are no rules in ' . get_class($this) . ' for update validation please set $storeRules property or $rules for both store and update in either the controller or the model');
        }
    }

    protected function stored()
    {
        return redirect(route("$this->route.index"))->with('success', trans('تم الاضافه بنجاح'));
    }

    protected function updated()
    {
        return redirect(route("$this->route.index"))->with('success', trans('تم التعديل'));
    }

    protected function destroyed()
    {
        return redirect(route("$this->route.index"))->with('success', trans('تم الحذف بنجاح'));
    }
}
