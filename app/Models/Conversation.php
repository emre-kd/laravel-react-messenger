<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $filable = [
        'user_id1',
        'user_id2',
        'last_message_id',
    ];

    /**
     * Get the lastMessage that owns the Conversation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lastMessage()
    {
        return $this->belongsTo(User::class, 'last_message_id');
    }

    /**
     * Get the user1 that owns the Conversation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user1()
    {
        return $this->belongsTo(User::class, 'user_id1');
    }

    /**
     * Get the user2 that owns the Conversation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user2()
    {
        return $this->belongsTo(User::class, 'user_id2');
    }

    public static function getConversationsForSideBar (User $exceptUser){
        $users = User::getUsersExceptUser($exceptUser);
        $groups = Group::getGroupsForUser($exceptUser);
        return $users->map(function (User $user) {
            return $user->toConversationArray();
        })->concat($groups->map(function (Group $group) {
            return $group->toConversationArray();
        }));
    }
}
