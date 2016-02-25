<?php

namespace zenstruck\string;

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
        return array(
            array('foo', 'foo'),
            array('foo    bar', 'foo bar'),
            array('foo &nbsp;   bar', 'foo bar'),
            array("  foo &nbsp;   \n\n\n  \r  bar", ' foo bar'),
        );
    }

    public function null_trim_provider()
    {
        return array(
            //array(null, null, null),
            array('0', null, '0'),
            array('foo', null, 'foo'),
            array('  foo', null, 'foo'),
            array('foo  ', null, 'foo'),
            array('  foo  ', null, 'foo'),
            array('foo / ', '/ ', 'foo'),
            array('/  foo  ', ' /', 'foo'),
            array('', null, null),
            array(' ', null, null),
            array('  ', null, null),
            array(
                array(' ', 'foo', null, '  foo', array('foo', '', ' ')),
                null,
                array(null, 'foo', null, 'foo', array('foo', null, null)),
            ),
            array(
                array(' /', 'foo/', '/', '  /foo', array('foo /', '/', '   / ')),
                ' /',
                array(null, 'foo', null, 'foo', array('foo', null, null)),
            ),
            array(
                array('foo' => '   bar  ', 'bar' => '     '),
                null,
                array('foo' => 'bar', 'bar' => null),
            ),
        );
    }

    public function truncate_word_provider()
    {
        return array(
            array(null, 255, '', ''),
            array('', 255, '', ''),
            array('', 255, '...', ''),
            array('foo', 3, '...', 'foo'),
            array('foo', 2, '', ''),
            array('foo', 2, '...', ''),
            array('foo bar', 3, '', 'foo'),
            array('foo bar baz', 6, '', 'foo'),
            array('foo bar baz', 7, '', 'foo bar'),
            array('foo bar baz', 7, '...', 'foo...'),
            array('foo bar baz', 9, '...', 'foo...'),
            array('foo bar baz', 10, '...', 'foo bar...'),
            array('foo bar baz', 11, '...', 'foo bar baz'),
            array('foo bar baz bob', 11, '...', 'foo bar...'),
            array('foo bar baz', 12, '...', 'foo bar baz'),
            array('      foo       bar  baz', 10, '...', 'foo bar...'),
        );
    }
}
