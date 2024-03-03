<?php

namespace App\Console\Commands;

use App\Events\DeviceStatusUpdated;
use App\Models\Device;
use Illuminate\Console\Command;
use PhpMqtt\Client\Facades\MQTT;

class ListenMQTT extends Command
{
    protected $signature = 'mqtt:listen';

    protected $description = 'Listen for MQTT messages';

    public function handle()
    {
        echo "Listening for MQTT messages \n";

        $mqtt = MQTT::connection();

        $topic = env('MQTT_TOPIC');

        $mqtt->subscribe($topic, function (string $topic, string $message) {
            $decodeMessage = json_decode($message, true);

            /* Replace `$decodeMessage['end_device_ids']['device_id']` with the corresponding structure from the body
            of the message send by your broker */
            $device = Device::where('name', $decodeMessage['end_device_ids']['device_id'])->get()->first();

            event(new DeviceStatusUpdated($device));
        }, 1);

        $mqtt->loop(true);
    }
}
