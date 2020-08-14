<?php

namespace Larapress\Notifications\SMSService;

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
                'in_ids'
            ]),
            'ids' => 'required',
            'sms_message' => 'required',
            'gateway' => 'required|exists:sms_gateways,id'
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
}
