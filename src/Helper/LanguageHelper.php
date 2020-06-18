<?php declare(strict_types = 1);

namespace Suilven\RandomEnglish\Helper;

use Doctrine\Inflector\InflectorFactory;

class LanguageHelper
{
    /** @var \Doctrine\Inflector\Inflector */
    private $inflector;


    public function __construct()
    {
        // English only
        $this->inflector = InflectorFactory::create()->build();
    }


    public function pluralizeNoun($noun)
    {
        return $this->inflector->pluralize($noun);
    }


    public function ingVerb($verb)
    {
        $verbPart = \rtrim($verb, 'e');

        return $verbPart . 'ing';
    }
}
