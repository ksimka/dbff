<?php

namespace Dbff\Element;

/**
 * Index element test
 * 
 * @package Dbff\Element
 */
class IndexTest extends AbstractElementTest
{
    /**
     * @return array
     */
    public function providerElements()
    {
        return [
            [
                new Index('', '', [], ''),
                [
                    'type' => '',
                    'columns' => [],
                    'algo' => '',
                ],
                '',
            ],
            [
                new Index('idx1', 'unique', ['id'], 'btree'),
                [
                    'type' => 'unique',
                    'columns' => ['id'],
                    'algo' => 'btree',
                ],
                'idx1',
            ],
        ];
    }
}
