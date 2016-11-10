<?php

namespace Sergiors\Silex\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Sergiors\Silex\Form\Type\RecaptchaType;
use Sergiors\Silex\Validator\Constraints\RecaptchaValidator;

/**
 * @author Sérgio Rafael Siqueira <sergio@inbep.com.br>
 */
final class RecaptchaServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        if (!isset($app['twig'])) {
            throw new \LogicException(
                'You must register the TwigServiceProvider to use the RecaptchaServiceProvider.'
            );
        }

        if (!isset($app['form.types'])) {
            throw new \LogicException(
                'You must register the FormServiceProvider to use the RecaptchaServiceProvider.'
            );
        }

        $app['twig.loader.filesystem'] = $app->extend('twig.loader.filesystem',
            function (\Twig_Loader_Filesystem $loader) {
                $loader->addPath(__DIR__.'/../../Resources/views/Form');
                return $loader;
            }
        );

        $app['twig.form.templates'] = array_merge($app['twig.form.templates'], [
            'recaptcha_widget.html.twig'
        ]);

        $app['form.types'] = $app->extend('form.types', function (array $types) use ($app) {
            $types[] = new RecaptchaType($app['recaptcha.sitekey']);
            return $types;
        });

        $app['validator.recaptcha'] = function (Container $app) {
            return new RecaptchaValidator($app['recaptcha.secretkey'], $app['request_stack']);
        };

        $app['validator.validator_service_ids'] = array_merge($app['validator.validator_service_ids'], [
            'validator.recaptcha' => 'validator.recaptcha'
        ]);

        $app['recaptcha.sitekey'] = null;
        $app['recaptcha.secretkey'] = null;
    }
}
