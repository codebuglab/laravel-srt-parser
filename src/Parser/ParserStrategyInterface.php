<?php

namespace CodeBugLab\SrtParser\Parser;

interface ParserStrategyInterface
{
    public function parse(string $path);
}
