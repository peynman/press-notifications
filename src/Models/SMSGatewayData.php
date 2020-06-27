<?php


namespace Larapress\Notifications\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;
use Larapress\CRUD\Exceptions\AppException;
use Larapress\CRUD\ICRUDUser;
use Larapress\Notifications\SMSService\Gatewayes\NexmoSMSGateway;

/**
 * @property int            $id
 * @property int            $author_id
 * @property string         $name
 * @property int            $flags
 * @property array          $data
 * @property ICRUDUSer      $author
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 */
class SMSGatewayData extends Model
{
    use SoftDeletes;

	protected $table = 'sms_gateways';

	protected $fillable = [
		'author_id',
		'name',
		'data',
		'flags',
	];

	protected $casts = [
		'data' => 'array',
    ];


	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function author() {
        return $this->belongsTo(config('larapress.crud.user.class'), 'author_id');
    }

    /**
     * create an instance of ISMSGateway if required data are
     *  present on GatewayData Model
     *
     * @return ISMSGateway
     */
    public function getGateway() {
        if (!isset($this->data['gateway'])) {
            throw new Exception("SMS Gateway not defined");
        }
        $gatewaysMap = config('larapress.notifications.sms.gateways');
        if (!isset($gatewaysMap[$this->data['gateway']])) {
            throw new Exception("SMS Gateway not found with asked name: ".$this->data['gateway']);
        }
        $gatewayClass = $gatewaysMap[$this->data['gateway']];
        /** @var ISMSGateway */
        $gateway = new $gatewayClass();
        $gateway->config($this->data);
        return $gateway;
    }

    const FLAGS_DISABLED = 1;
}
