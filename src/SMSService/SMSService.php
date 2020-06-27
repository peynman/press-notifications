<?php


namespace Larapress\Notifications\SMSService;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Larapress\Notifications\Models\SMSGatewayData;
use Larapress\Profiles\Models\Domain;

class SMSService implements ISMSService
{
    /**
     * Find an appropriate gateway data based on domain
     *
     * @param Larapress\Profiles\Models\Domain $domain
     * @return SMSGatewayData
     */
    public function findGatewayData(Domain $domain) {
        $gateways = SMSGatewayData::query()
            ->whereRaw(DB::raw('(sms_gateways.flags & '.SMSGatewayData::FLAGS_DISABLED.') = 0'))
            ->get();

        foreach ($gateways as $gateway) {
            if (isset($gateway->data['disable_in_domains'])) {
                if (in_array($domain->id, $gateway->data['disable_in_domains'])) {
                    foreach ($gateway->data['enable_in_domains'] as $domainId => $status) {
                        if ($status && $domainId == $domain->id) {
                            continue; // move to next gateway
                        }
                    }
                }
            }
            if (isset($gateway->data['enable_in_domains']) && count($gateway->data['enable_in_domains']) > 0) {
                foreach ($gateway->data['enable_in_domains'] as $domainId => $status) {
                    if (!$status && $domainId == $domain->id) {
                        continue; // move to next gateway
                    }
                }
            }

            Log::debug($gateway);

            return $gateway;
        }

        return null;
    }
}
