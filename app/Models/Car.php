<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $table = 'cars';

    protected $primaryKey = 'id';

    protected $fillable = ['name', 'founded', 'description', 'image_path', 'user_id'];

    protected $hidden = ['created_at', 'updated_at'];

    protected $visible = ['name', 'id', 'description', 'founded'];

    public function carModels() {
        return $this->hasMany(CarModel::class);
    }

    public function headquarter() {
        return $this->hasOne(Headquarter::class);
    }

    public function engines() {
        return $this->hasManyThrough(
            Engine::class, 
            CarModel::class,
            'car_id', //Foreign key on CarModel table
            'model_id' //Foreign key on Engine table
        );
    }

    //define a has one through relationship
    public function productionDate() {
        return $this->hasOneThrough(
            CarProductionDate::class,
            CarModel::class,
            'car_id', //Foreign key on CarModel table
            'model_id' //Foreign key on CarProductionDate table
        );
    }

    public function products() {
        return $this->belongsToMany(Product::class);
    }



}
