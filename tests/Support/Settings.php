<?php

namespace Tests\Support;

use App\Models\Setting;

class Settings
{
    private Setting $setting;

    private function __construct()
    {
        $this->setting = Setting::factory()->create();
    }

    public static function initialize(): Settings
    {
        return new self();
    }

    public function enableMultipleFullCompanySupport(): Settings
    {
        return $this->update(['full_multiple_companies_support' => 1]);
    }

    public function enableWebhook(): Settings
    {
        return $this->update([
            'webhook_botname' => 'SnipeBot5000',
            'webhook_endpoint' => 'https://hooks.slack.com/services/NZ59/Q446/672N',
            'webhook_channel' => '#it',
        ]);
    }

    public function disableWebhook(): Settings
    {
        return $this->update([
            'webhook_botname' => '',
            'webhook_endpoint' => '',
            'webhook_channel' => '',
        ]);
    }

    /**
     * @param array $attributes Attributes to modify in the application's settings.
     */
    public function set(array $attributes): Settings
    {
        return $this->update($attributes);
    }

    private function update(array $attributes): Settings
    {
        Setting::unguarded(fn() => $this->setting->update($attributes));
        Setting::$_cache = null;

        return $this;
    }
}
