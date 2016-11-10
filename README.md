Recaptcha Service Provider
--------------------------

Install
-------
```bash
composer require sergiors/recaptcha-service-provider "dev-master"
```

```php
use Silex\Provider\TwigServiceProvider;
use Sergiors\Silex\Provider\RecaptchaServiceProvider;

$app->register(new TwigServiceProvider());
$app->register(new RecaptchaServiceProvider());
```

License
-------
MIT
