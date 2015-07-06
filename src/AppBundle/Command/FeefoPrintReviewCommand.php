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
        $reviewUrl = "http://www.feefo.com/feefo/xmlfeed.jsp?logon=www.amara.co.uk&vendorref=$productId&limit=1";

        $reviews = file_get_contents($reviewUrl);

        $count = [];
        preg_match('/\\<COUNT\\>([0-9]+)\\<\\/COUNT\\>/i', $reviews, $count);

        $average = [];
        preg_match('/\\<AVERAGE\\>([0-9]+)\\<\\/AVERAGE\\>/i', $reviews, $average);

        $output->writeln("There are {$count[1]} reviews and the average is {$average[1]}%");
    }
}