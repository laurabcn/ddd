<?php
declare(strict_types=1);

namespace App\Activities\Infrastructure\Commands;

use App\Activities\Domain\FilesReader\FilesReader;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GetActivitiesDiputacioLanguages extends ContainerAwareCommand
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
            ->setName('get:diputacio:language')
            ->setDescription('Insert data from activities to Barcelona')
            ->addArgument(
                'language',
                InputArgument::REQUIRED,
                'es : español, en : english, ru : russian, de : aleman, fr : Frances'
            )
            ->setHelp('This command get data for tourism calendar...')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            'Extract highlights to Barcelona',
            '================================',
        ]);

        $output->writeln($this->someMethod($input));
        $output->writeln('Whoa!');
        $output->write('You are about to ');
        $output->write('create a user.');
    }

    private function someMethod(InputInterface $input)
    {
        $language = $input->getArgument('language');

        if(in_array($language, ['es', 'en', 'ru', 'de', 'fr'] ))
        {
            $this->reader->read($language);
        }
    }
}