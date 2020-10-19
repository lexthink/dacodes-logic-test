<?php

declare(strict_types=1);

/*
 * This file is part of the lexthink/dacodes-logic-test package.
 *
 * (c) Manuel Alejandro Paz Cetina <lexthink@icloud.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LexThink\Logic;

use Symfony\Component\Console\Exception\InvalidArgumentException;

final class Validator
{
    public function validateNumberOfTestCases(?string $cases): string
    {
        if (! is_numeric($cases) || ! ctype_digit($cases) || 0 === (int) $cases) {
            throw new InvalidArgumentException('The number of test cases (T) must be a natural number.');
        }

        if (! filter_var($cases, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1, 'max_range' => 5000]])) {
            throw new InvalidArgumentException('The number of test cases (T) must be in the range of 1 to 5000.');
        }

        return $cases;
    }

    public function validateNumberOfRowsAndColumns(?string $grid): string
    {
        if (null === $grid || 1 !== preg_match('/^[0-9]+,[0-9]+$/', $grid)) {
            throw new InvalidArgumentException(
                'The number of rows and columns (N,M) must be two natural numbers separated by a comma.'
            );
        }

        list($rows, $columns) = explode(',', $grid);

        if (! filter_var($rows, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1, 'max_range' => 10 ** 9]])) {
            throw new InvalidArgumentException(sprintf(
                'The number of rows of the grid must be in the range of %d to %d.',
                1,
                10 ** 9
            ));
        }

        if (! filter_var($columns, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1, 'max_range' => 10 ** 9]])) {
            throw new InvalidArgumentException(sprintf(
                'The number of columns of the grid must be in the range of %d to %d.',
                1,
                10 ** 9
            ));
        }

        return $grid;
    }
}
