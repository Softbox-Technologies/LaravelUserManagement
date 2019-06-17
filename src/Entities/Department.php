<?php

namespace Mekaeil\LaravelUserManagement\Entities;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(config("laravel_user_management.user_department_table"));
    }

    protected $fillable = [
        'title',
        'slug',
        'parent_id',
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function parent()
    {
        return $this->hasMany(Department::class);
    }

    public function children()
    {
        return $this->belongsTo(Department::class,'parent_id','id');
    }

    public function users()
    {
        return $this->belongsToMany(
            Department::class,
            'user_department_users',
            'department_id',
            'user_id'
        );
    }

}
