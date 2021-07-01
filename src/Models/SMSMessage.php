<?php


namespace Larapress\Notifications\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Larapress\Profiles\IProfileUser;
use Larapress\Profiles\Models\PhoneNumber;

/**
 * @property int            $id
 * @property int            $author_id
 * @property int            $sms_gateway_id
 * @property string         $from
 * @property string         $to
 * @property string         $message
 * @property int            $status
 * @property int            $flags
 * @property array          $data
 * @property SMSGatewayData $sms_gateway
 * @property IProfileUser   $author
 * @property PhoneNumber    $phone_number
 * @property \Carbon\Carbon $delivered_at
 * @property \Carbon\Carbon $send_at
 * @property \Carbon\Carbon $sent_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 */
class SMSMessage extends Model
{
    use SoftDeletes;

    protected $table = 'sms_messages';

    protected $fillable = [
        'author_id',
        'sms_gateway_id',
        'phone_id',
        'to',
        'from',
        'message',
        'status',
        'flags',
        'delivered_at',
        'sent_at',
        'data'
    ];

    protected $dates = [
        'delivered_at',
        'send_at',
        'sent_at',
    ];

    protected $casts = [
        'data' => 'array'
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
    public function sms_gateway()
    {
        return $this->belongsTo(SMSGatewayData::class, 'sms_gateway_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function phone_number()
    {
        return $this->belongsTo(PhoneNumber::class, 'phone_id');
    }

    const STATUS_CREATED = 1;
    const STATUS_SENT = 2;
    const STATUS_FAILED_SEND = 3;
    const STATUS_RECEIVED = 4;

    const FLAGS_VERIFICATION_MESSAGE = 1;
    const FLAGS_BATCH_SEND = 2;
}
