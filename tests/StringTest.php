<?php

/**
 * @author Kevin Bond <kevinbond@gmail.com>
 */
class StringTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider remove_whitespace_provider
     */
    public function test_remove_whitespace($str, $expected)
    {
        $this->assertSame($expected, remove_whitespace($str));
    }

    /**
     * @dataProvider null_trim_provider
     */
    public function test_null_trim($data, $character_mask, $expected)
    {
        $this->assertSame($expected, null_trim($data, $character_mask));
    }

    /**
     * @dataProvider truncate_word_provider
     */
    public function test_truncate_word($str, $length, $suffix, $expected)
    {
        $this->assertSame($expected, truncate_word($str, $length, $suffix));
    }

    public function remove_whitespace_provider()
    {
        return [
            ['foo', 'foo'],
            ['foo    bar', 'foo bar'],
            ['foo &nbsp;   bar', 'foo bar'],
            ["  foo &nbsp;   \n\n\n  \r  bar", ' foo bar'],
        ];
    }

    public function null_trim_provider()
    {
        return [
            [null, null, null],
            ['0', null, '0'],
            ['foo', null, 'foo'],
            ['  foo', null, 'foo'],
            ['foo  ', null, 'foo'],
            ['  foo  ', null, 'foo'],
            ['foo / ', '/ ', 'foo'],
            ['/  foo  ', ' /', 'foo'],
            ['', null, null],
            [' ', null, null],
            ['  ', null, null],
            [
                [' ', 'foo', null, '  foo', ['foo', '', ' ']],
                null,
                [null, 'foo', null, 'foo', ['foo', null, null]],
            ],
            [
                [' /', 'foo/', '/', '  /foo', ['foo /', '/', '   / ']],
                ' /',
                [null, 'foo', null, 'foo', ['foo', null, null]],
            ],
            [
                ['foo' => '   bar  ', 'bar' => '     '],
                null,
                ['foo' => 'bar', 'bar' => null],
            ],
        ];
    }

    public function truncate_word_provider()
    {
        return [
            [null, 255, '', ''],
            ['', 255, '', ''],
            ['', 255, '...', ''],
            ['foo', 3, '...', 'foo'],
            ['foo', 2, '', ''],
            ['foo', 2, '...', ''],
            ['foo bar', 3, '', 'foo'],
            ['foo bar baz', 6, '', 'foo'],
            ['foo bar baz', 7, '', 'foo bar'],
            ['foo bar baz', 7, '...', 'foo...'],
            ['foo bar baz', 9, '...', 'foo...'],
            ['foo bar baz', 10, '...', 'foo bar...'],
            ['foo bar baz', 11, '...', 'foo bar baz'],
            ['foo bar baz bob', 11, '...', 'foo bar...'],
            ['foo bar baz', 12, '...', 'foo bar baz'],
            ['      foo       bar  baz', 10, '...', 'foo bar...'],
        ];
    }
}
