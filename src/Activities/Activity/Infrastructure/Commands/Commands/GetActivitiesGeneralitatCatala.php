<?php
declare(strict_types=1);

namespace App\Activities\Infrastructure\Commands;

use App\Activities\Domain\FilesReader\FilesReader;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GetActivitiesGeneralitatCatala extends ContainerAwareCommand
{
    private $reader;

    public function __construct(?string $name = null, FilesReader $reader)
    {
        parent::__construct($name);
        $this->reader = $reader;
    }

    protected function configure()
    {
        $this
            ->setName('get:generalitat:catala')
            ->setDescription('Insert data from activities to Barcelona')
            ->setHelp('This command get data for tourism calendar...')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            'Extract highlights to Barcelona',
            '================================',
        ]);

        $output->writeln($this->someMethod());
        $output->writeln('Whoa!');
    }

    private function someMethod()
    {
        $this->reader->read('ca');
    }
}