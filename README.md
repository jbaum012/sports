# Sports

To get up and running (from the cloned repo directory)

1. Copy the dev/local env file

`copy .env.local.example .env`

2. Create a temporary docker box to install composer packages

``` bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/opt \
    -w /opt \
    laravelsail/php80-composer:latest \
    composer install --ignore-platform-reqs
```

3. Bring up the sail box `./vendor/bin/sail up`

However, instead of repeatedly typing vendor/bin/sail to execute Sail commands, you may wish to configure a Bash alias that allows you to execute Sail's commands more easily:

``` bash
alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'
```

4. generate an app key `sail artisan key:generate`

5. compile the css/js `sail npm i && npm run dev`

check out packages.json for other commands.  I can only get `npm run hot` on the sail box, so to get hot reloading you'll need to do `sail npm run hot`.

6.
