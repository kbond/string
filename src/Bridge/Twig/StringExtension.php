<?php

namespace Zenstruck\String\Bridge\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

/**
 * @author Kevin Bond <kevinbond@gmail.com>
 */
final class StringExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('remove_whitespace', 'remove_whitespace'),
            new TwigFilter('null_trim', 'null_trim'),
            new TwigFilter('truncate_word', 'truncate_word'),
        ];
    }
}
