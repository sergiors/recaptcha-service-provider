<?php

namespace Sergiors\Silex\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * @author Sérgio Rafael Siqueira <sergio@inbep.com.br>
 */
final class RecaptchaType extends AbstractType
{
    /**
     * @var string
     */
    private $sitekey;

    /**
     * @param string $sitekey
     */
    public function __construct($sitekey)
    {
        $this->sitekey = $sitekey;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'mapped' => false,
            'compound' => false,
            'attr' => [
                'data-sitekey' => $this->sitekey,
                'class' => 'g-recaptcha',
            ],
            'constraints' => [
                new NotBlank(),
            ],
        ]);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'recaptcha';
    }
}
