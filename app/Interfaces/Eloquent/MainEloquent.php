<?php

namespace App\Interfaces\Eloquent;

interface MainEloquent {

    public function getAll();

    public function getById($id);

    public function save($inputs, $getId = false);

    public function update($inputs, $id);

    public function delete($id);

}
