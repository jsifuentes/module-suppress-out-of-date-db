<?php

namespace Sifuen\SuppressOutOfDateDb\Console\Command;

use Magento\Framework\App\State;
use Sifuen\SuppressOutOfDateDb\Helper\Config;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ToggleModule
 * @package Sifuen\SuppressOutOfDateDb\Console\Command
 */
class ToggleModule extends Command
{
    /**
     * @var Config
     */
    private $configHelper;

    /**
     * @var State
     */
    private $state;

    /**
     * ToggleModule constructor.
     * @param Config $configHelper
     * @param State $state
     */
    public function __construct(
        Config $configHelper,
        State $state
    )
    {
        parent::__construct();
        $this->configHelper = $configHelper;
        $this->state = $state;
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName('dev:db:toggle-errors')
            ->setDescription('Toggle whether the "Please upgrade your database" exception is thrown when your ' .
                'database is out of date.');
        parent::configure();
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if ($this->isInProductionMode()) {
            $output->writeln('<error>This command is not meant to be run in producton mode. Please consider keeping ' .
                'your modules up to date.</error>');
            $output->writeln('');
        }

        $currentValue = $this->configHelper->isModuleActive();
        $newValue = !$currentValue;
        $this->configHelper->setIsModuleActive($newValue);

        $prefix = ($newValue ? 'Enabled' : 'Disabled');
        $output->writeln('<info>' . $prefix . ' database version exception messages</info>');

        if ($newValue) {
            $output->writeln('');
            $output->writeln('<comment>Database version exception messages will now show in the system messages ' .
                'banner in the backend.</comment>');
        }
    }

    /**
     * @return bool
     */
    protected function isInProductionMode()
    {
        return $this->state->getMode() === State::MODE_PRODUCTION;
    }
}