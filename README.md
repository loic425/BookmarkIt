<h1 align="center">
    BookmarkIt
    <br />
    <a href="http://travis-ci.org/loic425/BookmarkIt" title="Build status" target="_blank">
        <img src="https://img.shields.io/travis/loic425/BookmarkIt/master.svg" />
    </a>
    <a href="https://scrutinizer-ci.com/g/loic425/BookmarkIt/" title="Scrutinizer" target="_blank">
        <img src="https://img.shields.io/scrutinizer/g/loic425/BookmarkIt.svg" />
    </a>    
</h1>

Init project
------------

Install php dependencies using composer
```bash
$ composer install
```

Install project :
```bash
$ bin/console app:install
$ yarn install && yarn run gulp
$ php bin/console server:start
```

[Behat](http://behat.org) scenarios
-----------------------------------

By default Behat uses `http://localhost:8080/` as your application base url. If your one is different,
you need to create `behat.yml` files that will overwrite it with your custom url:

```yaml
imports: ["behat.yml.dist"]

default:
    extensions:
        Behat\MinkExtension:
            base_url: http://my.custom.url
```

Then run selenium-server-standalone:

```bash
$ vendor/bin/selenium-server-standalone -Dwebdriver.chrome.driver=path/to/chromedriver
```

Then setup your test database:

```bash
$ php bin/console doctrine:database:create --env=test
$ php bin/console doctrine:migrations:migrate --env=test
```

You can run Behat using the following commands:

```bash
$ vendor/bin/behat
```
