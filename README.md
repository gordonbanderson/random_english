# Random English
[![Build Status](https://travis-ci.org/gordonbanderson/random_english.svg?branch=master)](https://travis-ci.org/gordonbanderson/random_english)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/gordonbanderson/random_english/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/gordonbanderson/random_english/?branch=master)
[![codecov.io](https://codecov.io/github/gordonbanderson/random_english/coverage.svg?branch=master)](https://codecov.io/github/gordonbanderson/random_english?branch=master)


[![Latest Stable Version](https://poser.pugx.org/suilven/random-english/version)](https://packagist.org/packages/suilven/random-english)
[![Latest Unstable Version](https://poser.pugx.org/suilven/random-english/v/unstable)](//packagist.org/packages/suilven/random-english)
[![Total Downloads](https://poser.pugx.org/suilven/random-english/downloads)](https://packagist.org/packages/suilven/random-english)
[![License](https://poser.pugx.org/suilven/random-english/license)](https://packagist.org/packages/suilven/random-english)
[![Monthly Downloads](https://poser.pugx.org/suilven/random-english/d/monthly)](https://packagist.org/packages/suilven/random-english)
[![Daily Downloads](https://poser.pugx.org/suilven/random-english/d/daily)](https://packagist.org/packages/suilven/random-english)
[![composer.lock](https://poser.pugx.org/suilven/random-english/composerlock)](https://packagist.org/packages/suilven/random-english)

[![GitHub Code Size](https://img.shields.io/github/languages/code-size/gordonbanderson/random_english)](https://github.com/gordonbanderson/random_english)
[![GitHub Repo Size](https://img.shields.io/github/repo-size/gordonbanderson/random_english)](https://github.com/gordonbanderson/random_english)
[![GitHub Last Commit](https://img.shields.io/github/last-commit/gordonbanderson/random_english)](https://github.com/gordonbanderson/random_english)
[![GitHub Activity](https://img.shields.io/github/commit-activity/m/gordonbanderson/random_english)](https://github.com/gordonbanderson/random_english)
[![GitHub Issues](https://img.shields.io/github/issues/gordonbanderson/random_english)](https://github.com/gordonbanderson/random_english/issues)

![codecov.io](https://codecov.io/github/gordonbanderson/random_english/branch.svg?branch=master)

Generate random text that is plausible English, although it will not be semantically correct.

## Getting Started

Firstly there is no need for this software to be installed on a live system, it is purely intended for creating test
data such as fixtures.

### Prerequisites

PHP 7.2 is required

```
Give examples
```

### Installing

```
composer require --dev suilven/random-english
```

## Usage

### Scripts
#### Random Sentences
The parameter 4 is the number of sentences to return
```
> bin/randomEnglish sentences 4
Shut in, however, by nine, it was terrible to sun his piano, which we had observed with the sorry house.
Foresting at night is more fun than seconding during the day.
Try!! You cannot wire here.
The minute is colour kenyan copper.
```

#### Random Paragraphs
The parameter 2 is the number of random paragraphs
```
> bin/randomEnglish paragraphs  2
Cat juices are best eaten with propers.  The spread in Pakistan is healthy.  The down is a storm of an female flog and is gold in the voice for his stomach and the mildness of his die.  Wait!! You cannot add here.  The park is colour cornflower blue.  Thea opened the tall and found that it led into a cheap fever, not much larger than a through.  The inside weather was paning on the across bank.  The further great double into the beer.  How slowly the hide passes here, encompassed as I am by fly and fit?  Among these were a couple of countrys, a toeing catch I employed sometimes, a sick hurting a skill, Gregg the butcher and his little boy, and two or three loafers and golf caddies who were accustomed to hang about the railway station.
---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
Wish!! You cannot second here.  This is a random string from 1 to 4 two.  Tom's younger brother (or rather half-brother) Sid was already through with his part of the work (picking up chips), for he was a quiet boy, and had no adventurous, trouble-some ways.  The something gold ladder round the comb.  The decrease is a pull of an try were and is garden in the brush for his coin and the mildness of his come.  It was piano in the line, there star was sound.  Reminding at night is more fun than answering during the day.  Shut in, however, by road, it was through to fruit his cost, which we had observed with the model taste.  Were it not for the works, the south clean would not be out.  The salt film was snowing on the close bank.
---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
```

### PHP
Prime the generator with a configuration as below, or leave blank to choose random structures from `config/sentence-structure.cfg`
```bash
$generator = new RandomEnglishGenerator();
$generator->setConfig('It was [adjective] in the [noun], [contraction] [noun] was [adjective]');

$generator->sentence(); // generate a random sentence
$generator->title(); // generate a random sentence in Title Case
$generator->paragraph(10); // generate a random paragraph of up to a max of 10 sentences
```

## Configuration
Sentence structures are defined in `config/sentence-structure.cfg` and look like this

```
The [noun] was [verb_ing] [adverb]
The [noun] in [country] is [adjective]
The [noun] is colour [colour]
This is a random string from 1 to 4 [one|two|three|four]
```

The random generation works as follows:
* A random line from the configuration file is chosen.
* Any words not in square brackets are output as is.
* A string of the form `[one|two|three|four]` represents a choice of random words, either `one`, `two`, `three` or
`four` will be appended to the sentence.
* The directory `words` contains various text files with lists of words representative of the filename.  A directive of
`[noun]` will result in the file `words/english_nouns.txt` being loaded and a random word chosen from the file.
* Exceptions
  * `[country]` will load `words/english_countries.txt`, just a semanatic thing
  * `[verb_ing]` will take a verb and render if with a trailing `ing`
  * `[plural_noun]` will take a noun from the file `words/english_countable_nouns.txt` and pluralize it with an inflector
* The following are commands to run against Faker to generate random entries, e.g. `[lastName]` will generate a last name.
```
'address',
        'name',
        'randomDigit',
        'randomLetter',
        'randomNumber',
        'title',
        'titleMale',
        'titleFemale',
        'firstNameMale',
        'firstNameFemale',
        'lastName',

        'catchPhrase',
        'bs',
        'company',
        'companySuffix',
        'jobTitle',

        'realText',

        'dayOfWeek',
        'monthName',
```

## Running the tests

1) Build Docker image and enter it in a bash shell
```
sudo docker-compse up -d phpcli
sudo docker-compose exec phpcli /bin/bash
```
Note the first step may take several minutes if not previously built.

A bash prompt will appear like this:

```
> sdc exec phpcli /bin/bash
 ____                 _                   _____             _ _     _     
|  _ \ __ _ _ __   __| | ___  _ __ ___   | ____|_ __   __ _| (_)___| |__  
| |_) / _` | '_ \ / _` |/ _ \| '_ ` _ \  |  _| | '_ \ / _` | | / __| '_ \ 
|  _ < (_| | | | | (_| | (_) | | | | | | | |___| | | | (_| | | \__ \ | | |
|_| \_\__,_|_| |_|\__,_|\___/|_| |_| |_| |_____|_| |_|\__, |_|_|___/_| |_|
                                                      |___/               
root@randomenglish.test:/var/www> 
```

## Versioning

We use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/your/project/tags). 

## Authors

* **Gordon Anderson** - *Initial work* - [Gordon Anderson](https://github.com/gordonbanderson)


## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details


## Data Sources
* Wiktionary - different word classifications
* Mens Names - Office of National Statistics https://www.ons.gov.uk/peoplepopulationandcommunity/birthsdeathsandmarriages/livebirths/datasets/babynamesenglandandwalesbabynamesstatisticsboys
* Womens Names - Office of National Statistics https://www.ons.gov.uk/peoplepopulationandcommunity/birthsdeathsandmarriages/livebirths/datasets/babynamesenglandandwalesbabynamesstatisticsgirls
* Countries - OSM Overpass API, https://wiki.openstreetmap.org/wiki/Countries_of_the_world
* Colours - https://github.com/codebrainz/color-names/blob/master/output/colors.csv
