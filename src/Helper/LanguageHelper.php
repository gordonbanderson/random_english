<?php declare(strict_types = 1);

namespace Suilven\RandomEnglish\Helper;

use Doctrine\Inflector\InflectorFactory;

class LanguageHelper
{
    private const DOUBLE_LAST_CHARS = ['b', 'd', 'g', 'l', 'm', 'n', 'p', 't'];

    private const DO_NOT_DOUBLE_LAST_CHAR_TWO_CHARS = [
        'mb',
        'ad',
        'ld',
        'dd',
        'ed',
        'nd',
        'rd',
        'gg',
        'ng',
        'nt',
        'en',
        'wn',
        'rn',
        'am',
        'om',
        'rm',
        'rn',
        'lp',
        'ep',
        'mp',
        'op',
        'rp',
        'up',
        'ct',
        'at',
        'et',
        'ht',
        'lm',
        'lt',
        'ut',
        'ot',
        'pt',
        'rt',
        'st',
    ];

    private const DO_NOT_DOUBLE_LAST_CHAR_THREE_CHARS = [
        'ain',
        'ait',
        'ion',
        'oin',
        'son',
        'oap',
        'oon',
        'ron',
        // visit
        'sit',
        'tim',
    ];


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
        $lastThreeChars = \substr($verb, -3);

        $verbPart = $verb;
        if (\substr($verb, -1) === 'e' && \substr($verb, -2) !== 'ee') {
            $verbPart = \rtrim($verb, 'e');
        }

        if (\in_array($lastChar, self::DOUBLE_LAST_CHARS, true)
            && !\in_array($lastTwoChars, self::DO_NOT_DOUBLE_LAST_CHAR_TWO_CHARS, true)
            && !\in_array($lastThreeChars, self::DO_NOT_DOUBLE_LAST_CHAR_THREE_CHARS, true)
        ) {
            $verbPart .= $lastChar;
        }

        $result = $verbPart . 'ing';

        // deal with lie ->lying
        $result = \str_replace('iing', 'ying', $result);

        // deal with special cases
        switch ($verb) {
            case 'sit':
                $result = 'sitting';

                break;
        }

        return $result;
    }
}
