<?php

namespace Larapress\Notifications\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Larapress\Profiles\IProfileUser;

/**
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property IProfileUser   $user
 * @property IProfileUser   $author
 * @property int            $id
 */
class Notification extends Model
{
    const STATUS_CREATED = 1;
    const STATUS_UNSEEN = 2;
    const STATUS_DISMISSED = 3;
    const STATUS_SEEN = 4;

    const FLAGS_SENT = 1;
    const FLAGS_WEB_ONLY = 2;
    const FLAGS_DEVICE_ONLY = 4;

    use SoftDeletes;

    protected $table = 'user_notifications';

    protected $fillable = [
        'author_id',
        'user_id',
        'title',
        'message',
        'data',
        'status',
        'flags',
    ];

    protected $casts = [
        'data' => 'array',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(config('larapress.crud.user.model'), 'author_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(config('larapress.crud.user.model'), 'user_id');
    }
}
