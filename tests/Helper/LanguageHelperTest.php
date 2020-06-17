<?php declare(strict_types = 1);

namespace Tests\Suilven\RandomEnglish\Helper;

use PHPUnit\Framework\TestCase;
use Suilven\RandomEnglish\Helper\LanguageHelper;
use Suilven\RandomEnglish\RandomEnglishGenerator;

class LanguageHelperTest extends TestCase
{

    /** @var LanguageHelper  */
    private $helper;

    public function setUp(): void
    {
        parent::setUp();

        $this->helper = new LanguageHelper();

    }


    public function testPluralNouns()
    {
        $this->assertEquals('trees', $this->helper->pluralizeNoun('tree'));
        $this->assertEquals('dogs', $this->helper->pluralizeNoun('dog'));
        $this->assertEquals('buses', $this->helper->pluralizeNoun('buses'));
        $this->assertEquals('sheep', $this->helper->pluralizeNoun('sheep'));
        $this->assertEquals('matrices', $this->helper->pluralizeNoun('matrix'));
    }


    public function testIngVerb()
    {
        $this->assertEquals('testing', $this->helper->ingVerb('test'));
        $this->assertEquals('queuing', $this->helper->ingVerb('queue'));
    }


}
