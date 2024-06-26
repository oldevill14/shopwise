<?php

namespace Botble\Payment\Supports;

use Botble\Payment\Enums\PaymentMethodEnum;
use Botble\Payment\Events\RenderedPaymentMethods;
use Botble\Payment\Events\RenderingPaymentMethods;

class PaymentMethods
{
    protected array $methods = [];

    public function method(string $name, array $args = []): self
    {
        $args = array_merge(['html' => null, 'priority' => count($this->methods) + 1], $args);

        $this->methods[$name] = $args;

        return $this;
    }

    public function methods(): array
    {
        return $this->methods;
    }

    public function getDefaultMethod(): ?string
    {
        return setting('default_payment_method', PaymentMethodEnum::COD);
    }

    public function getSelectedMethod(): ?string
    {
        return session('selected_payment_method');
    }

    public function getSelectingMethod(): ?string
    {
        return $this->getSelectedMethod() ?: $this->getDefaultMethod();
    }

    public function render(): string
    {
        $this->methods = [
            PaymentMethodEnum::COD => [
                'html' => view('plugins/payment::partials.cod')->render(),
                'priority' => 998,
            ],
            PaymentMethodEnum::BANK_TRANSFER => [
                'html' => view('plugins/payment::partials.bank-transfer')->render(),
                'priority' => 999,
            ],
        ] + $this->methods;

        event(new RenderingPaymentMethods($this->methods));

        $country = apply_filters('payment_checkout_country', null);

        $html = '';

        foreach (collect($this->methods)->sortBy('priority') as $name => $method) {
            if (! get_payment_setting('status', $name) == 1) {
                continue;
            }

            if ($country && ! in_array($country, array_keys(PaymentHelper::getAvailableCountries($name)))) {
                continue;
            }

            $html .= $method['html'];
        }

        event(new RenderedPaymentMethods($html));

        return $html;
    }
}
