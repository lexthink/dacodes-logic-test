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

final class Logic
{
    /**
     * @param int    $rows    the number of rows (N)
     * @param int    $columns the number of columns (M)
     * @param int    $x       the starting row index
     * @param int    $y       the starting column index
     * @param string $dir     the starting direction
     *
     * @return string the ending direction
     */
    public function __invoke(int $rows, int $columns, int $x = 0, int $y = 0, string $dir = ''): string
    {
        // if lies outside the grid
        if ($x >= $rows || $y >= $columns) {
            return $dir;
        }

        // traverse first Row
        // for ($i = $x; $i < $columns; $i++) { /* $arr[$x][$i] walk to the right; */ }
        if ($x < $columns) {
            $dir = 'R';
        }

        // traverse last Column
        // for ($i = $x + 1; $i < $rows; $i++) { /* $arr[$i][$columns - 1] walk to the bottom; */ }
        if ($x + 1 < $rows) {
            $dir = 'D';
        }

        // traverse last row, if last and first row are not same
        if (($rows - 1) != $x) {
            // for ($i = $columns - 2; $i >= $y; $i++) { /* $arr[$rows - 1][$i] walk to the left; */ }
            if ($columns - 2 >= $y) {
                $dir = 'L';
            }
        }

        // traverse first column, if last and first column are not same
        if (($columns - 1) != $y) {
            // for ($i = $rows - 2; $i > $x; $i++) { /* $arr[$i][$y] walk to the top; */ }
            if ($rows - 2 > $x) {
                $dir = 'U';
            }
        }

        // recursive call, decrease the dimensions of the grid
        return $this($rows - 1, $columns - 1, $x + 1, $y + 1, $dir);
    }
}
