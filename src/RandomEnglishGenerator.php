<?php
namespace Suilven\RandomEnglish;

class RandomEnglishGenerator
{
    /** @var string configuration file for sentences */
    private $config = '';

    const POSSIBLE_WORD_TYPES = [
        'verb',
        'noun',
        'adjective',
        'preposition',
        'conjunction',
        'contraction'
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
     * @return string a random sentence
     */
    public function sentence()
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

        return implode(" ", $sentenceArray) . '.';
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
