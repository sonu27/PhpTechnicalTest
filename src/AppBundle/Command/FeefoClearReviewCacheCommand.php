<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * FeefoPrintReviewCommand
 */
class FeefoClearReviewCacheCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('feefo:clear-reviews-cache')
            ->setDescription('Clears the cache for Feefo product reviews');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $service   = $this->getContainer()->get('feefo.review');
        $deleted   = $service->deleteAll();

        $output->writeln($deleted.' Feefo product review(s) deleted.');
    }
}
