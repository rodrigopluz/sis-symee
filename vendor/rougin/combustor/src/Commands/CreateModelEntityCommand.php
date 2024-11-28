<?php

namespace Rougin\Combustor\Commands;

use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Rougin\Combustor\Common\File;
use Rougin\Combustor\Common\Tools;
use Rougin\Combustor\Validator\ModelEntityValidator;
use Rougin\Combustor\Generator\ModelEntityGenerator;

/**
 * Create Model Entity Command
 *
 * Generates a Wildfire or Doctrine-based model for CodeIgniter
 *
 * @package Combustor
 * @author  Rougin Royce Gutib <rougingutib@gmail.com>
 */
class CreateModelEntityCommand extends AbstractCommand
{
    /**
     * @var string
     */
    protected $command = 'entity';

    /**
     * Sets the configurations of the specified command.
     *
     * @return void
     */
    protected function configure()
    {
        $this
            ->setName('create:entity')
            ->setDescription('Creates a new model entity')
            ->addArgument(
                'name',
                InputArgument::REQUIRED,
                'Name of the table'
            )->addOption(
                'camel',
                null,
                InputOption::VALUE_NONE,
                'Uses the camel case naming convention'
            )->addOption(
                'lowercase',
                null,
                InputOption::VALUE_NONE,
                'Keeps the first character of the name to lowercase'
            );
    }

    /**
     * Executes the command.
     *
     * @param \Symfony\Component\Console\Input\InputInterface   $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     * @return object|\Symfony\Component\Console\Output\OutputInterface
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $fileName = ucwords(str_replace('_', ' ', $input->getArgument('name')));

        $path = APPPATH . 'models' . DIRECTORY_SEPARATOR . 'Entity' . DIRECTORY_SEPARATOR . str_replace(' ', '', $fileName) . '.php';

        $info = [
            'name' => str_replace(' ', '', $fileName),
            'type' => 'model',
            'path' => $path
        ];

        $validator = new ModelEntityValidator($input->getOption('camel'), $info);

        if ($validator->fails()) {
            $message = $validator->getMessage();

            return $output->writeln('<error>' . $message . '</error>');
        }

        $data = [
            'file' => $info,
            'type' => $validator->getLibrary(),
            'isCamel' => $input->getOption('camel'),
            'tabela' => $input->getArgument('name'),
            'name' => str_replace(' ', '', $fileName)
        ];

        $generator = new ModelEntityGenerator($this->describe, $data);

        $result = $generator->generate();
        $model = $this->renderer->render('ModelEntity.tpl', $result);
        $message = 'The model entity "' . str_replace(' ', '', $fileName) . '" has been created successfully!';

        $file = new File($path);

        $file->putContents($model);
        $file->close();

        return $output->writeln('<info>' . $message . '</info>');
    }
}
