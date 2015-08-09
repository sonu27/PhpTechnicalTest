<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * FeefoPrintReviewCommand
 */
class FeefoPrintReviewCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('feefo:print-reviews')
            ->setDescription('Prints out the Feefo reviews for a product')
            ->addArgument('id', InputArgument::REQUIRED, 'Id of the product');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $productId = $input->getArgument('id');
        $service   = $this->getContainer()->get('feefo_review');
        $review    = $service->get($productId);

        $output->writeln("There are {$review['count']} reviews and the average is {$review['average']}%");
    }
}
