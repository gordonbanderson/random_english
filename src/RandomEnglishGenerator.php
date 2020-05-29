<?php
namespace Suilven\RandomEnglish;

class RandomEnglishGenerator
{
    /** @var string configuration file for sentences */
    private $config = '';

    const POSSIBLE_WORD_TYPES = [
        'noun',
        'countable_noun',

        'adjective',
        'preposition',
        'conjunction',
        'contraction',
        'control_verb',

        'sequence_adverb',
        'frequency_adverb',

        // pluralize and ing these?
        'intransitive_verb',
        'irregular_verb',
        'transitive_verb',
        'verb',


        // positions
        'locative',


    ];

    public function __construct()
    {
        $configFile = dirname(__FILE__) . '/../config/sentence-structure.cfg';
        $this->setConfig(file_get_contents($configFile));
    }


    /**
     * @param string $newConfig configuration file of how sentence structures
     */
    public function setConfig($newConfig) : void
    {
        $this->config = trim($newConfig);
    }


    /**
     * Generate a random sentence
     *
     * @param bool $titleCase true to generate a title, false (default) to generate a sentence
     * @return string a random sentence
     */
    public function sentence($titleCase = false)
    {
        $structures = explode(PHP_EOL, $this->config);
        shuffle($structures);
        $structure = $structures[0];
        
        $expression='/[\s]+/';
        $splits = preg_split($expression, $structure, -1, PREG_SPLIT_NO_EMPTY);

        $sentenceArray = [];
        foreach ($splits as $possiblyRandomWord) {
            $randomized = false;
            foreach (self::POSSIBLE_WORD_TYPES as $wordType) {
                $start = '[' . $wordType . ']';
                if (substr($possiblyRandomWord, 0, strlen($start)) === $start) {
                    $restOfWord = str_replace($start, '', $possiblyRandomWord);
                    $sentenceArray[] = $this->getRandomWord($wordType) . $restOfWord;
                    $randomized = true;
                    break;
                }
            }

            if (!$randomized) {
                $sentenceArray[] = $possiblyRandomWord;
            }
        }

        // ensure sentence starts with a capital
        $sentenceArray[0] = ucfirst($sentenceArray[0]);

        $result = implode(" ", $sentenceArray) . '.';
        if ($titleCase) {
            $result = ucwords($result);
            $result = substr_replace($result, "", -1);
        }

        return $result;
    }


    /**
     * Generate a random title
     * @return string a random sentence, all in caps, no trailing full stop
     */
    public function title()
    {
        return $this->sentence(true);
    }


    /**
     * @param int $maxSentences The maximum number of sentences
     * @return string a paragraph of random sentences
     */
    public function paragraph($maxSentences = 10)
    {
        $nParagraph = rand(1, $maxSentences);
        $sentences = [];
        for ($i=0; $i< $maxSentences; $i++) {
            $sentences[] = $this->sentence();
        }

        return implode("  ", $sentences);
    }


    /**
     * @return string a plural noun
     */
    public function pluralNoun()
    {
        $plurableNoun = $this->getRandomWord('countable_noun');
        return $plurableNoun . 's';
    }


    /**
     * @return string a plural verb
     */
    public function pluralVerb()
    {
        // @todo Choose a random verb source file
        $plurableNoun = $this->getRandomWord('verb');
        return $plurableNoun . 's';
    }


    /**
     * @return string doing version of a verb
     */
    public function verbing()
    {
        // @todo Choose a random verb source file
        $plurableNoun = $this->getRandomWord('verb');
        return $plurableNoun . 'ing';
    }


    /**
     * @param string $wordType the type of word, e.g. noun, verb
     * @return string a random word for the given word type
     */
    private function getRandomWord($wordType)
    {
        $wordsFile = dirname(__FILE__) . '/../words/english_' . $wordType . 's.txt';
        $words = explode(PHP_EOL, trim(file_get_contents($wordsFile)));
        shuffle($words);
        return $words[0];
    }
}
