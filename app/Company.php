<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    const DEFAULT_LOGO = 'images/no-image.png';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'logo', 'email', 'website'
    ];

    /**
     * ORM relationship
     * Company belongs to a User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * ORM relationship
     * A Company has many Employee(s)
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    /**
     * get the asset path, fixed issue with finding images
     * without the 'storage/'. it can fail in production
     * @return string
     */
    static function getAssetPath()
    {
        return asset('storage').'/';
    }

    /**
     * Accessor to give default image if no logo provided
     * and fix path
     *
     * @param $value
     */
    public function getLogoAttribute($value)
    {
        if ($value == null) {
            return asset(self::DEFAULT_LOGO);
        }

        return $this->getAssetPath().$value;
    }
}
