<?php

namespace Larapress\Notifications\Services\SMSService;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class BatchSendSMSRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type' => 'required|in:' . implode(',', [
                'not_in_form_enty_tags',
                'in_form_entry_tags',
                'not_in_form_entries',
                'in_form_entries',
                'not_in_purchased_ids',
                'in_purchased_ids',
                'all_except_ids',
                'in_ids'
            ]),
            'ids' => 'required_unless:type,all_except_ids',
            'sms_message' => 'required',
            'gateway' => 'required|exists:sms_gateways,id',
            'roles.*' => 'nullable|exists:roles,id',
            'domains.*' => 'nullable|exists:domains,id',
            'from' => 'nullable|datetime_zoned',
            'to' => 'nullable|datetime_zoned',
        ];
    }

    public function getType() {
        return $this->request->get('type');
    }

    public function getIds() {
        $ids = $this->request->get('ids');
        if (is_string($ids)) {
            return explode(",", $ids);
        } else {
            if (!is_array($ids)) {
                return [$ids];
            }

            return $ids;
        }
    }

    public function getMessage() {
        return $this->request->get('sms_message');
    }

    public function getGatewayID() {
        return $this->request->get('gateway');
    }

    public function getRoleIds() {
        return array_keys($this->request->get('roles', []));
    }

    public function getDomainIds() {
        return array_keys($this->request->get('domains', []));
    }

    public function shouldFilterRoles() {
        return count($this->getRoleIds()) > 0;
    }

    public function shouldFilterDomains() {
        return count($this->getDomainIds()) > 0;
    }

    public function getRegisteredFrom() {
        $time = $this->request->get('from', null);
        if (!is_null($time)) {
            $time = Carbon::createFromFormat("Y-m-d\TH:i:sO", $time);
        }
        return $time;
    }

    public function getRegisteredTo() {
        $time = $this->request->get('to', null);
        if (!is_null($time)) {
            $time = Carbon::createFromFormat("Y-m-d\TH:i:sO", $time);
        }
        return $time;
    }
}
