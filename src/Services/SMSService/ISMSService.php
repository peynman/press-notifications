<?php


namespace Larapress\Notifications\Services\SMSService;

use Larapress\Profiles\Models\Domain;
use Larapress\Notifications\Models\SMSMessage;

interface ISMSService
{
    /**
     * Find an appropriate gateway data based on domain
     *
     * @param Larapress\Profiles\Models\Domain|null $domain
     * @return SMSGatewayData
     */
    public function findGatewayData(Domain $domain);

    /**
     * Undocumented function
     *
     * @return SMSMessage[]
     */
    public function queueSMSMessagesForRequest(BatchSendSMSRequest $request);
}
