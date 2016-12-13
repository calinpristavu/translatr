<?php

namespace Evozon\TranslatrBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class AbstractCommand
 *
 * @package     Evozon\TranslatrBundle\Command
 * @author      Ovidiu Enache <i.ovidiuenache@yahoo.com>
 */
abstract class AbstractCommand extends ContainerAwareCommand
{
    /**
     * @param OutputInterface $output
     * @param string          $name
     * @param array           $parameters
     *
     * @throws \Exception
     */
    protected function runCommand(OutputInterface $output, $name, $parameters = [])
    {
        try {
            $command = $this->getApplication()->find($name);

            unset($parameters['command']);

            $command->run(new ArrayInput(array_merge(['command' => $name], $parameters)), $output);
        } catch (\Exception $e) {
            $output->writeln(
                sprintf('<error>There was an error running command "%s": "%s"</error>', $name, $e->getMessage())
            );
        }
    }
}
