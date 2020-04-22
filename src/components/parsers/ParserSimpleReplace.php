<?php
namespace extas\components\parsers;

use extas\components\Item;
use extas\components\Replace;
use extas\interfaces\parsers\IParseDispatcher;

/**
 * Class ParserSimpleReplace
 *
 * @package extas\components\parsers
 * @author jeyroik@gmail.com
 */
class ParserSimpleReplace extends Item implements IParseDispatcher
{
    public const FIELD__PARAM_NAME = 'param_name';
    public const FIELD__MARKER = 'marker';

    /**
     * @param mixed $value
     * @return mixed|string|string[]
     */
    public function __invoke($value)
    {
        $paramName = $this->getParamName();
        if (isset($this[$paramName])) {
            return Replace::please()->apply([
                $this->getMarker() => $this->config[$paramName]
            ])->to($value);
        }

        return $value;
    }

    /**
     * @return string
     */
    protected function getMarker(): string
    {
        $marker = $this->config[static::FIELD__MARKER] ?? '';

        return $marker ?: $this->getParamName();
    }

    /**
     * @return string
     */
    protected function getParamName(): string
    {
        return $this->config[static::FIELD__PARAM_NAME] ?? '';
    }

    protected function getSubjectForExtension(): string
    {
        return 'extas.parser.simple.replace';
    }
}
