## About Blu

Blu is a Laravel instances monitor. It allows you to monitor your Laravel instances and get notified when something goes wrong.

I'm working on this project in my free time, so it's not ready for production yet. I'll be adding more features and fixing bugs as soon as I can.

## Requirements

- PHP >= 8.2
- Composer
- MySQL/MariaDB or whatever database you want to use that is supported by Laravel
- Redis
- A web server (Apache, Nginx, etc.)

## Installation
Clone the repository and install the dependencies.

```bash
git clone https://github.com/WebXScripts/Blu.git
cd Blu
composer install
```

Copy the `.env.example` file to `.env` and fill in the required information.

```bash
cp .env.example .env
```

Generate the application key.

```bash
php artisan key:generate
```

Run the migrations.

```bash
php artisan migrate
```

## Docker

You can also use docker to run the application.

```bash
docker-compose up -d
```

## Planned features

Implementing these features is not a priority for me, but I'll be adding them as soon as I can.

- [x] Add caching
- [ ] Add tests
- [ ] Add a way to add multiple users

Important things to do:

- [ ] Server scraping (It's coded and it works, but it's not finished yet.)
- [ ] Add a way to add multiple notifications (email, Slack, etc.)

## Contributing

If you want to contribute to this project, you can do it in two ways:

- [Open an issue](https://github.com/WebXScripts/Blu/issues/new)
- [Open a pull request](https://github.com/WebXScripts/Blu/compare)

## License

Blu is open-sourced software licensed under the [Apache License 2.0](https://github.com/WebXScripts/Blu/blob/1.0/LICENSE).

## Support

If you want to support me, you can do it by [buying me a coffee](https://www.buymeacoffee.com/webxscripts).
