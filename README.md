# Laravel MQTT Listener

Example project that uses MQTT and Websockets connections to comunicate in real-time with devices. This project is built with Laravel and VueJs in the front-end using InertiaJs.

This project uses `php-mqtt/laravel-client` and `beyondcode/laravel-websockets` to communicate via MQTT and Websockets respectevely. For the front-end it uses `laravel-echo` and `pusher`.

## How to use it

To try the project you can clone this repository and follow the next instructions:

-   Run `cp .env.example .env` and make sure to replace the enviroments variables with the information from your mqtt broker and `laravel-websockets` for the websocket server.
-   Install all the `composer` and `npm` dependencies.
-   Run `php artisan key:generate`
-   Start the container using `laravel-sail` command `./vendor/bin/sail up -d && sail npm run dev`
-   Run the migrations for the database, you can do so by executing `./vendor/bin/sail artisan migrate`.
-   In different terminals you need to run the following commands as they block the terminal. The commands are `./vendor/bin/sail artisan mqtt:listen` to start the mqtt listener and `./vendor/bin/sail websockets:serve` to spin up the websockets server.
-   Next you should register a user and create some dummy devices. As there are not any interface where you can register devices in the website you'll have to create them manually using `tinker`.

To register devices run `./vendor/bin/sail tinker` and run the following command:

```php
$user = User::where("email", 'youruser@email.com')->first();

$user->devices()->createMany([
    [
        'name' => 'your-device-name',
        'app_eui' => 'your-app-eui',
        'dev_eui' => 'your-dev-eui'
    ],
]);
```

## Notes

For now this is a pretty basic implementation for mqtt and websockets and I aim to keep improving this repository, some of my ideas for the future are:

-   Use supervisor to manage the application and make sure everything stays working persistenly without stoping.
-   Create interfaces to register devices, even though I think this will depend on the MQTT broker you use.
-   Make changes on how sensors are displayed in the dashboard make enfasis on the relevant.
-   Broadcast differete events depending of the type of the messages receipt such as uplink, downlink, last-will, etc.
