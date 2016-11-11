<?php

namespace Sergiors\Silex\Tests\Provider;

use Silex\Application;
use Silex\Provider\FormServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Sergiors\Silex\Provider\RecaptchaServiceProvider;
use Sergiors\Silex\Validator\Constraints\RecaptchaValidator;

class RecaptchaServiceProviderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function register()
    {
        $app = $this->createApplication();
        $app->register(new FormServiceProvider());
        $app->register(new ValidatorServiceProvider());
        $app->register(new TwigServiceProvider());
        $app->register(new RecaptchaServiceProvider(), [
            'recaptcha.sitekey' => 'fake',
            'recaptcha.secretkey' => 'fake',
        ]);

        $this->assertInstanceOf(RecaptchaValidator::class, $app['validator.recaptcha']);
    }

    public function createApplication()
    {
        return new Application();
    }
}
