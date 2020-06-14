<?php


namespace Larapress\Notifications\SMSService;

use Larapress\Profiles\Models\Domain;

interface ISMSService
{
    /**
     * Find an appropriate gateway data based on domain
     *
     * @param Larapress\Profiles\Models\Domain|null $domain
     * @return SMSGatewayData
     */
    public function findGatewayData(Domain $domain);
}
