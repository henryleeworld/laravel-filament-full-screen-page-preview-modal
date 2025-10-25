<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactEntry extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'email',
        'message',
        'name',
    ];
}
