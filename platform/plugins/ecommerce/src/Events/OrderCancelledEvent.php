<?php

namespace Botble\Ecommerce\Events;

use Botble\Base\Events\Event;
use Botble\Ecommerce\Models\Order;
use Illuminate\Queue\SerializesModels;

class OrderCancelledEvent extends Event
{
    use SerializesModels;

    public function __construct(
        public Order $order,
        public ?string $reason = null,
        public ?string $reasonDescription = null
    ) {
    }
}
