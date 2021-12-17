<?php

namespace CodeBugLab\SrtParser\Parser;

use DateTime;

class ArrayParserStrategy implements ParserStrategyInterface
{

    const STATE_NUMBER = 0;
    const STATE_TIME = 1;
    const STATE_TEXT = 2;

    public function parse(string $path): array
    {
        $lines   = file($path);
        $lines[] = "\n"; // add empty line in the end to show last record

        $subs    = [];

        $state   = self::STATE_NUMBER;

        $subNumber  = 0;
        $subText = [];
        $subTime = '';

        foreach ($lines as $line) {
            switch ($state) {
                case self::STATE_NUMBER:
                    $subNumber = trim($line);
                    $state  = self::STATE_TIME;
                    break;
                case self::STATE_TIME:
                    $subTime = trim($line);
                    $state   = self::STATE_TEXT;
                    break;
                case self::STATE_TEXT:
                    if (trim($line) == '') {
                        $sub = [];
                        $sub['number'] = $subNumber;
                        list($sub['startTime'], $sub['stopTime']) = explode(' --> ', $subTime);
                        $sub['duration'] = $this->getLineDuration($sub['startTime'], $sub['stopTime']);
                        $sub['text']   = $this->prepareText($subText);
                        $subText     = [];
                        $state       = self::STATE_NUMBER;
                        $subs[]      = $sub;
                    } else {
                        $subText[] = $line;
                    }
                    break;
            }
        }

        return $subs;
    }

    private function getLineDuration($start, $stop): float
    {
        return $this->getMillisecondFromSubTime($stop) - $this->getMillisecondFromSubTime($start);
    }

    private function prepareText(array $text): array
    {
        return array_map('trim', preg_replace('/\s\s+/', ' ', $text));
    }

    private function getMillisecondFromSubTime($time): float
    {
        $timeObject = DateTime::createFromFormat('H:i:s,u', $time);

        return $timeObject->getTimeStamp() . '.' . $timeObject->format('u');
    }
}
