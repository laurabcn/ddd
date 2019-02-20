<?php

namespace App\Activities\Infrastructure\Commands;

use App\Activities\Domain\FilesReader\FilesReader;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class setTouristActivitiesCommand extends ContainerAwareCommand
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
            // the name of the command (the part after "bin/console")
            ->setName('app:create-user')

            // the short description shown while running "php bin/console list"
            ->setDescription('Insert data from activities to Barcelona')
            ->addArgument(
                'language',
                InputArgument::REQUIRED,
                'ca : Català, es : español, en : english, ru : russian, de : aleman, fr : Frances'
            )
            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('This command get data for tourism calendar...')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        //parent::execute($input, $output);

        $output->writeln([
            'Extract highlights to Barcelona',
            '================================',
            '',
        ]);

        // the value returned by someMethod() can be an iterator (https://secure.php.net/iterator)
        // that generates and returns the messages with the 'yield' PHP keyword
        $output->writeln($this->someMethod($input));

        // outputs a message followed by a "\n"
        $output->writeln('Whoa!');

        // outputs a message without adding a "\n" at the end of the line
        $output->write('You are about to ');
        $output->write('create a user.');
    }

    private function someMethod(InputInterface $input)
    {
        $language = $input->getArgument('language');

        $this->reader->read($language);
    }
}