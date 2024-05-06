<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $filable = [
        'name',
        'description',
        'owner_id',
        'last_message_id',
    ];

    /**
     * The users that belong to the Group
     *
     * @return \Illuminate\Database\User\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'group_users');
    }

    /**
     * Get all of the messages for the Group
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    /**
     * Get the owner that owns the Group
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(User::class);
    }
}
