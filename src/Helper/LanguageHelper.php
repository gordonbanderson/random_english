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


    /**
     * @param string $noun A noun
     * @return string the plurarl of that noun
     */
    public function pluralizeNoun(string $noun): string
    {
        return $this->inflector->pluralize($noun);
    }


    /**
     * @param string $verb a verb
     * @return string the ing version of the verb
     */
    public function ingVerb(string $verb): string
    {
        $verbPart = \rtrim($verb, 'e');

        return $verbPart . 'ing';
    }
}
