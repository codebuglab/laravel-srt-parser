<?php

namespace CodeBugLab\SrtParser;

use CodeBugLab\SrtParser\Parser\ArrayParserStrategy;

class SrtParser
{

    protected $path;

    public function load(string $path)
    {
        $this->path = $path;

        return $this;
    }

    public function toArray()
    {
        return (new ArrayParserStrategy())->parse($this->path);
    }
}
