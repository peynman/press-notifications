<?php


namespace Larapress\Notifications\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Larapress\CRUD\ICRUDUser;
use Larapress\Notifications\Factories\SMSGatewayDataFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Larapress\Notifications\Services\SMSService\ISMSGateway;

/**
 * @property int            $id
 * @property int            $author_id
 * @property string         $name
 * @property string         $gateway
 * @property int            $flags
 * @property array          $data
 * @property ICRUDUSer      $author
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 */
class SMSGatewayData extends Model
{
    use HasFactory;
    use SoftDeletes;

    const FLAGS_DISABLED = 1;

    protected $table = 'sms_gateways';

    protected $fillable = [
        'author_id',
        'name',
        'gateway',
        'data',
        'flags',
    ];

    protected $casts = [
        'data' => 'array',
    ];

    /**
     * Undocumented function
     *
     * @return Factory
     */
    protected static function newFactory()
    {
        return SMSGatewayDataFactory::new();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(config('larapress.crud.user.model'), 'author_id');
    }

    /**
     * create an instance of ISMSGateway if required data are
     *  present on GatewayData Model
     *
     * @return ISMSGateway
     */
    public function getGateway()
    {
        $gatewaysMap = config('larapress.notifications.sms.gateways');
        if (!isset($gatewaysMap[$this->gateway])) {
            throw new Exception("SMS Gateway not found with asked name: ".$this->data['gateway']);
        }
        $gatewayClass = $gatewaysMap[$this->gateway];
        /** @var ISMSGateway */
        $gateway = new $gatewayClass();
        $gateway->config($this->data);
        return $gateway;
    }
}
