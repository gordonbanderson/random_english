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
        $this->assertEquals('amusing', $this->helper->ingVerb('amuse'));
        $this->assertEquals('sitting', $this->helper->ingVerb('sit'));
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
        $this->assertEquals("wilding", $this->helper->ingVerb("wild"));


        $this->assertEquals("adding", $this->helper->ingVerb("add"));
        $this->assertEquals("bleeding", $this->helper->ingVerb("bleed"));
        $this->assertEquals("bottoming", $this->helper->ingVerb("bottom"));
        $this->assertEquals("browning", $this->helper->ingVerb("brown"));
        $this->assertEquals("burning", $this->helper->ingVerb("burn"));
        $this->assertEquals("chickening", $this->helper->ingVerb("chicken"));
        $this->assertEquals("climbing", $this->helper->ingVerb("climb"));
        $this->assertEquals("combing", $this->helper->ingVerb("comb"));
        $this->assertEquals("controlling", $this->helper->ingVerb("control"));
        $this->assertEquals("counting", $this->helper->ingVerb("count"));
        $this->assertEquals("developing", $this->helper->ingVerb("develop"));
        $this->assertEquals("dying", $this->helper->ingVerb("die"));
        $this->assertEquals("downing", $this->helper->ingVerb("down"));
        $this->assertEquals("dreaming", $this->helper->ingVerb("dream"));
        $this->assertEquals("earning", $this->helper->ingVerb("earn"));
        $this->assertEquals("egging", $this->helper->ingVerb("egg"));
        $this->assertEquals("equalling", $this->helper->ingVerb("equal"));
        $this->assertEquals("evening", $this->helper->ingVerb("even"));
        $this->assertEquals("eventing", $this->helper->ingVerb("event"));
        $this->assertEquals("excepting", $this->helper->ingVerb("except"));
        $this->assertEquals("faulting", $this->helper->ingVerb("fault"));
        $this->assertEquals("feeding", $this->helper->ingVerb("feed"));
        $this->assertEquals("filming", $this->helper->ingVerb("film"));
        $this->assertEquals("footing", $this->helper->ingVerb("foot"));
        $this->assertEquals("freeing", $this->helper->ingVerb("free"));
        $this->assertEquals("fronting", $this->helper->ingVerb("front"));
        $this->assertEquals("grouping", $this->helper->ingVerb("group"));
        $this->assertEquals("happening", $this->helper->ingVerb("happen"));
        $this->assertEquals("helping", $this->helper->ingVerb("help"));
        $this->assertEquals("inventing", $this->helper->ingVerb("invent"));
        $this->assertEquals("jumping", $this->helper->ingVerb("jump"));
        $this->assertEquals("keeping", $this->helper->ingVerb("keep"));
        $this->assertEquals("kneeing", $this->helper->ingVerb("knee"));
        $this->assertEquals("lamping", $this->helper->ingVerb("lamp"));
        $this->assertEquals("learning", $this->helper->ingVerb("learn"));
        $this->assertEquals("lying", $this->helper->ingVerb("lie"));
        $this->assertEquals("listening", $this->helper->ingVerb("listen"));
        $this->assertEquals("marketing", $this->helper->ingVerb("market"));
        $this->assertEquals("meeting", $this->helper->ingVerb("meet"));
        $this->assertEquals("needing", $this->helper->ingVerb("need"));
        $this->assertEquals("opening", $this->helper->ingVerb("open"));
        $this->assertEquals("outing", $this->helper->ingVerb("out"));
        $this->assertEquals("parenting", $this->helper->ingVerb("parent"));
        $this->assertEquals("pencilling", $this->helper->ingVerb("pencil"));
        $this->assertEquals("perfecting", $this->helper->ingVerb("perfect"));
        $this->assertEquals("planting", $this->helper->ingVerb("plant"));
        $this->assertEquals("pocketing", $this->helper->ingVerb("pocket"));
        $this->assertEquals("pointing", $this->helper->ingVerb("point"));
         $this->assertEquals("presenting", $this->helper->ingVerb("present"));
        $this->assertEquals("preventing", $this->helper->ingVerb("prevent"));
        $this->assertEquals("queening", $this->helper->ingVerb("queen"));
        $this->assertEquals("renting", $this->helper->ingVerb("rent"));
        $this->assertEquals("resulting", $this->helper->ingVerb("result"));
        $this->assertEquals("returning", $this->helper->ingVerb("return"));
        $this->assertEquals("rooming", $this->helper->ingVerb("room"));
        $this->assertEquals("seeing", $this->helper->ingVerb("see"));
        $this->assertEquals("seeding", $this->helper->ingVerb("seed"));
        $this->assertEquals("sharping", $this->helper->ingVerb("sharp"));
        $this->assertEquals("sheeting", $this->helper->ingVerb("sheet"));
        $this->assertEquals("shooting", $this->helper->ingVerb("shoot"));
        $this->assertEquals("shouting", $this->helper->ingVerb("shout"));
        $this->assertEquals("signalling", $this->helper->ingVerb("signal"));
        $this->assertEquals("sleeping", $this->helper->ingVerb("sleep"));
        $this->assertEquals("souping", $this->helper->ingVerb("soup"));
        $this->assertEquals("stamping", $this->helper->ingVerb("stamp"));
        $this->assertEquals("steaming", $this->helper->ingVerb("steam"));
        $this->assertEquals("teaming", $this->helper->ingVerb("team"));
        $this->assertEquals("totalling", $this->helper->ingVerb("total"));
        $this->assertEquals("travelling", $this->helper->ingVerb("travel"));
        $this->assertEquals("turning", $this->helper->ingVerb("turn"));
        $this->assertEquals("wanting", $this->helper->ingVerb("want"));
        $this->assertEquals("worrying", $this->helper->ingVerb("worry"));


        $this->assertEquals('stinging', $this->helper->ingVerb('sting'));
        $this->assertEquals('collecting', $this->helper->ingVerb('collect'));

        // @todo aim visit wait

        // possibly problematic
        $this->assertEquals("training", $this->helper->ingVerb("train"));
        $this->assertEquals("explaining", $this->helper->ingVerb("explain"));
        $this->assertEquals("containing", $this->helper->ingVerb("contain"));
        $this->assertEquals("coining", $this->helper->ingVerb("coin"));
        $this->assertEquals("joining", $this->helper->ingVerb("join"));

        //Counter example
        $this->assertEquals("spinning", $this->helper->ingVerb("spin"));
        $this->assertEquals("binning", $this->helper->ingVerb("bin"));


        $this->assertEquals("stationing", $this->helper->ingVerb("station"));
        $this->assertEquals("poisoning", $this->helper->ingVerb("poison"));
        $this->assertEquals("positioning", $this->helper->ingVerb("position"));
        $this->assertEquals("mooning", $this->helper->ingVerb("moon"));
        $this->assertEquals("ironing", $this->helper->ingVerb("iron"));
        $this->assertEquals("conditioning", $this->helper->ingVerb("condition"));
        $this->assertEquals("mentioning", $this->helper->ingVerb("mention"));
        $this->assertEquals("questioning", $this->helper->ingVerb("question"));

        //Counter example
        $this->assertEquals("conning", $this->helper->ingVerb("con"));


        $this->assertEquals("soaping", $this->helper->ingVerb("soap"));

        // counter example
        $this->assertEquals('clapping', $this->helper->ingVerb('clap'));



        $this->assertEquals("swimming", $this->helper->ingVerb("swim"));
        $this->assertEquals("trimming", $this->helper->ingVerb("trim"));

        // Counter example
        $this->assertEquals("timing", $this->helper->ingVerb("tim"));


        $this->assertEquals("visiting", $this->helper->ingVerb("visit"));
        $this->assertEquals("waiting", $this->helper->ingVerb("wait"));




        $this->assertEquals('queuing', $this->helper->ingVerb('queue'));
    }


    public function testAllVerbs(): void
    {
        $wordType = 'verb';
        $wordsFile = \dirname(__FILE__) . '/../../words/english_' . $wordType . 's.txt';
        $words = \explode(\PHP_EOL, \trim(\file_get_contents($wordsFile)));
        foreach ($words as $word) {
            \error_log($word . ' --> ' . $this->helper->ingVerb($word));
        }
    }
}
