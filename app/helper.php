<?php

use App\Models\HomeSetting;
use Illuminate\Support\Facades\Storage;

function store_file($file, $path)
{
    $name = time() . $file->getClientOriginalName();
    return $value = $file->storeAs($path, $name, 'uploads');
}
function delete_file($file)
{
    if ($file != '' and !is_null($file) and Storage::disk('uploads')->exists($file)) {
        unlink('uploads/' . $file);
    }
}
function display_file($name)
{
    return asset('uploads') . '/' . $name;
}

function home_setting($key, $value = null)
{
    if (is_array($key)) {
        foreach ($key as $k => $v) {
            if (is_object($v)) {
                delete_file($option = HomeSetting::where('key', $k)->first()?->value);
                $v = store_file($v, 'home_setting');
            }
            HomeSetting::updateOrCreate(['key' => $k], ['value' => $v]);
        }
        return true;
    }
    $option = HomeSetting::where('key', $key)->first();
    if ($value) {
        $option->update([$key => $value]);
    }
    return $option?->value;
}
