<?php

namespace Larapress\Notifications\CRUD;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Larapress\CRUD\Services\CRUD\Traits\CRUDProviderTrait;
use Larapress\CRUD\Services\CRUD\ICRUDProvider;
use Larapress\CRUD\Services\CRUD\ICRUDVerb;
use Larapress\CRUD\Services\RBAC\IPermissionsMetadata;

class SMSGatewayDataCRUDProvider implements ICRUDProvider
{
    use CRUDProviderTrait;

    public $name_in_config = 'larapress.notifications.routes.sms_gateways.name';
    public $model_in_config = 'larapress.notifications.routes.sms_gateways.model';
    public $compositions_in_config = 'larapress.notifications.routes.sms_gateways.compositions';

    public $verbs = [
        ICRUDVerb::VIEW,
        ICRUDVerb::CREATE,
        ICRUDVerb::EDIT,
        ICRUDVerb::DELETE
    ];
    public $createValidations = [
        'name' => 'required|string|unique:sms_gateways,name',
        'flags' => 'nullable|numeric',
        'data.gateway' => 'required|string',
    ];
    public $updateValidations = [
        'name' => 'required|string|unique:sms_gateways,name',
        'flags' => 'nullable|numeric',
        'data.gateway' => 'required|string',
    ];
    public $validSortColumns = [
        'id',
        'title',
        'gateway_id',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public $searchColumns = [
        'equals:id',
        'equals:gateway_id',
        'title',
    ];

    /**
     * Undocumented function
     *
     * @return array
     */
    public function getValidRelations(): array
    {
        return [
            'author' => config('larapress.crud.user.provider'),
        ];
    }

    /**
     * Exclude current id in name unique request
     *
     * @param Request $request
     *
     * @return array
     */
    public function getUpdateRules(Request $request): array
    {
        $this->updateValidations['name'] .= ',' . $request->route('id');
        return $this->updateValidations;
    }

    /**
     * Undocumented function
     *
     * @param array $args
     *
     * @return array
     */
    public function onBeforeCreate(array $args): array
    {
        $args['author_id'] = Auth::user()->id;

        return $args;
    }
}
