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
    }

}
