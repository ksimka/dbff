<?php

namespace Dbff\Builder;

use Dbff\Parser\TypeParser;
use Dbff\Element\TypeProps\BinProps;
use Dbff\Element\TypeProps\EmptyProps;
use Dbff\Element\TypeProps\FloatProps;
use Dbff\Element\TypeProps\IntProps;
use Dbff\Element\TypeProps\CharProps;
use Dbff\Element\TypeProps\TextProps;
use Dbff\Element\TypeProps\EnumProps;
use Dbff\Element\Type;

/**
 * Type element builder
 *
 * @package Dbff\Builder
 */
class TypeBuilder implements BuilderInterface
{
    /**
     * @var \Dbff\Parser\TypeParser
     */
    private $parser;

    /**
     * @param TypeParser $parser
     */
    public function __construct(TypeParser $parser)
    {
        $this->parser = $parser;
    }

    /**
     * Builds type element from string
     *
     * @param string $str
     * @return Type
     */
    public function createFromString($str)
    {
        $struct = $this->parser->parse($str);
        if (!$struct) {
            return new Type('', new EmptyProps());
        }

        switch ($struct['group']) {
            case 'int':
                return new Type(
                    $struct['type'],
                    new IntProps($struct['length'], $struct['unsigned'], $struct['zerofill'])
                );
            case 'float':
                return new Type(
                    $struct['type'],
                    new FloatProps($struct['length'], $struct['decimal'], $struct['unsigned'], $struct['zerofill'])
                );
            case 'char':
                return new Type(
                    $struct['type'],
                    new CharProps($struct['length'], $struct['charset'], $struct['collate'])
                );
            case 'text':
                return new Type(
                    $struct['type'],
                    new TextProps($struct['binary'], $struct['charset'], $struct['collate'])
                );
            case 'datetime':
            case 'blob':
                return new Type($struct['type'], new EmptyProps());
            case 'bin':
                return new Type($struct['type'], new BinProps($struct['length']));
            case 'enum':
                return new Type(
                    $struct['type'],
                    new EnumProps($struct['values'], $struct['charset'], $struct['collate'])
                );
        }

        return new Type('', new EmptyProps());
    }
}
