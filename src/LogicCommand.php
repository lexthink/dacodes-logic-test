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

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Stopwatch\Stopwatch;

final class LogicCommand extends Command
{
    // to make your command lazily loaded, configure the $defaultName static property,
    // so it will be instantiated only when the command is actually called.
    protected static $defaultName = 'logic';

    /**
     * @var SymfonyStyle
     */
    private $io;

    /**
     * @var Validator
     */
    private $validator;

    /**
     * This optional method is the first one executed for a command after configure()
     * and is useful to initialize properties based on the input arguments and options.
     */
    protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        $this->io = new SymfonyStyle($input, $output);
        $this->validator = new Validator();
    }

    protected function execute(InputInterface $input, OutputInterface $output): ?int
    {
        $stopwatch = new Stopwatch();
        $stopwatch->start('logic:test');

        $this->io->text($this->getApplication()->getLongVersion() . ' by Manuel Alejandro Paz Cetina.');

        $cases = (int) $this->io->ask('Test cases (T)', null, [$this->validator, 'validateNumberOfTestCases']);

        $grids = [];
        for ($i = 1; $i <= $cases; $i++) {
            $grids[] = $this->io->ask(
                sprintf('#%d - Rows and columns (N,M)', $i),
                null,
                [$this->validator, 'validateNumberOfRowsAndColumns']
            );
        }

        $this->io->title(sprintf(' Test cases: %d ', $cases));
        $this->io->section('  Input:  ');
        $this->io->listing($grids);

        $logic = new Logic();
        $results = [];
        foreach ($grids as $grid) {
            list($rows, $columns) = explode(',', $grid);
            $results[] = $logic((int) $rows, (int) $columns); // <---  do recursive logic test !!!
        }

        $this->io->section('  Output: ');
        $this->io->listing($results);

        $event = $stopwatch->stop('logic:test');
        if ($output->isVerbose()) {
            $this->io->comment(sprintf(
                'Number of test cases: %d / Elapsed time: %.2f ms / Consumed memory: %.2f MB',
                $cases,
                $event->getDuration(),
                $event->getMemory() / (1024 ** 2)
            ));
        }

        return 0;
    }
}
