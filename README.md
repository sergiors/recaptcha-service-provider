Recaptcha Service Provider
--------------------------

Register your site in [Google reCAPTCHA](www.google.com/recaptcha/)

Install
-------
```bash
composer require sergiors/recaptcha-service-provider "dev-master"
```

```php
use Silex\Provider\FormServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Sergiors\Silex\Provider\RecaptchaServiceProvider;

$app->register(new FormServiceProvider());
$app->register(new ValidatorServiceProvider());
$app->register(new TwigServiceProvider());
$app->register(new RecaptchaServiceProvider(), [
    'recaptcha.sitekey' => '',
    'recaptcha.secretkey' => '',
]);
```

#### Form
[More details how to use form](http://silex.sensiolabs.org/doc/master/providers/form.html)
```php
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Sergiors\Silex\Form\Type\RecaptchaType;
use Sergiors\Silex\Validator\Constraints\Recaptcha;

$form = $app['form.factory']->createBuilder(FormType::class, [])
    ->add('recaptcha', RecaptchaType::class, [
        'constraints' => [
            new Recaptcha()
        ]
    ])
    ->getForm();
```

#### In your template
```html
{{ form_widget(form.recaptcha) }}
```

License
-------
MIT
