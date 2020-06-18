<?php declare(strict_types = 1);

namespace Tests\Suilven\RandomEnglish\Helper;

use PHPUnit\Framework\TestCase;
use Suilven\RandomEnglish\Helper\LanguageHelper;

class LanguageHelperTest extends TestCase
{

    /** @var \Suilven\RandomEnglish\Helper\LanguageHelper */
    private $helper;

    public function setUp(): void
    {
        parent::setUp();

        $this->helper = new LanguageHelper();
    }


    public function testPluralNouns(): void
    {
        $this->assertEquals('trees', $this->helper->pluralizeNoun('tree'));
        $this->assertEquals('dogs', $this->helper->pluralizeNoun('dog'));
        $this->assertEquals('buses', $this->helper->pluralizeNoun('buses'));
        $this->assertEquals('sheep', $this->helper->pluralizeNoun('sheep'));
        $this->assertEquals('matrices', $this->helper->pluralizeNoun('matrix'));
    }


    public function testIngVerb(): void
    {
        $this->assertEquals('testing', $this->helper->ingVerb('test'));
        $this->assertEquals('kicking', $this->helper->ingVerb('kick'));
        $this->assertEquals('queuing', $this->helper->ingVerb('queue'));
        $this->assertEquals('amusing', $this->helper->ingVerb('amuse'));
        $this->assertEquals('sitting', $this->helper->ingVerb('sit'));
        $this->assertEquals('clapping', $this->helper->ingVerb('clap'));
        $this->assertEquals('clubbing', $this->helper->ingVerb('club'));
        $this->assertEquals('kidding', $this->helper->ingVerb('kid'));
        $this->assertEquals('dogging', $this->helper->ingVerb('dog'));
        $this->assertEquals('sporting', $this->helper->ingVerb('sport'));
        $this->assertEquals('spreading', $this->helper->ingVerb('spread'));
        $this->assertEquals('sweating', $this->helper->ingVerb('sweat'));
        $this->assertEquals('thinning', $this->helper->ingVerb('thin'));
        $this->assertEquals('thirding', $this->helper->ingVerb('third'));
        $this->assertEquals('warming', $this->helper->ingVerb('warm'));
        $this->assertEquals('weighting', $this->helper->ingVerb('weight'));
        $this->assertEquals('winding', $this->helper->ingVerb('wind'));
        $this->assertEquals('wilding', $this->helper->ingVerb('wild'));


        $this->assertEquals('stinging', $this->helper->ingVerb('sting'));
        $this->assertEquals('collecting', $this->helper->ingVerb('collect'));

        // @todo aim visit wait
    }


    public function testAllVerbs(): void {
        $wordType = 'verb';
        $wordsFile = \dirname(__FILE__) . '/../../words/english_' . $wordType . 's.txt';
        $words = \explode(\PHP_EOL, \trim(\file_get_contents($wordsFile)));
        foreach($words as $word) {
            error_log($word . ' --> ' . $this->helper->ingVerb($word));
        }
    }
}
