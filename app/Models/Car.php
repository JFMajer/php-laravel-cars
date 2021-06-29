<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $table = 'cars';

    protected $primaryKey = 'id';

    protected $fillable = ['name', 'founded', 'description'];

    protected $hidden = ['created_at', 'updated_at'];

    protected $visible = ['name', 'id', 'description', 'founded'];

    public function carModels() {
        return $this->hasMany(CarModel::class);
    }

}
