<?php declare(strict_types = 1);

namespace Suilven\RandomEnglish\Helper;

use Doctrine\Inflector\InflectorFactory;

class LanguageHelper
{
    private const DOUBLE_LAST_CHARS = ['b', 'd', 'g', 'm', 'n', 'p', 't'];

    private const DO_NOT_DOUBLE_LAST_CHAR_TWO_CHARS = ['ad', 'ld', 'nd', 'rd', 'ng', 'im',
        'rm', 'ct', 'at', 'ht', 'rt', 'st'];

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
     * Attempt to convert a verb into a verb with ing.
     *
     * @param string $verb a verb
     * @return string the ing version of the verb
     */
    public function ingVerb(string $verb): string
    {
        $lastChar = \substr($verb, -1);
        $lastTwoChars = \substr($verb, -2);
        $verbPart = \rtrim($verb, 'e');

        if (\in_array($lastChar, self::DOUBLE_LAST_CHARS, true)
        && !\in_array($lastTwoChars, self::DO_NOT_DOUBLE_LAST_CHAR_TWO_CHARS, true)) {
            $verbPart .= $lastChar;
        }

        return $verbPart . 'ing';
    }
}
