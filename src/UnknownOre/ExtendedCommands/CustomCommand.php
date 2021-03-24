<?php
namespace UnknownOre\ExtendedCommands;

use UnknownOre\ExtendedCommands\types\arguments\Argument;
use UnknownOre\ExtendedCommands\types\arguments\Arguments;
use UnknownOre\ExtendedCommands\types\requirements\Requirement;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;

abstract class CustomCommand extends Command {

    public function __construct(string $name, string $description = "", string $usageMessage = null, array $aliases = []){
        parent::__construct($name, $description, $usageMessage, $aliases);
        $this->prepare();
    }

    /**
     * @var Argument[]
     */
    private $arguments = [];

    /**
     * @var Requirement[]
     */
    private $requirements = [];

    /**
     * @return Argument[]
     */
    public function getArguments(): array {
        return $this->arguments;
    }

    public function addArgument(Argument $argument){
        $this->arguments[] = $argument;
    }

    public function getRequirements(): array {
        return $this->requirements;
    }

    public function addRequirement(Requirement $requirement){
        $this->requirements[] = $requirement;
    }

    public final function execute(CommandSender $sender, string $commandLabel, array $args){
        foreach ($this->requirements as $requirement) {
            if (!$requirement->verify($sender)) {
                $sender->sendMessage($requirement->getErrorMessage());
                return;
            }
        }

        $arguments = new Arguments();
        foreach ($this->arguments as $argument) {
            $argument = clone $argument;
            $value = array_shift($args);
            if ($value !== null) {
                $argument->setValue($value);
            } else {
                if ($argument->isDefaultSet()) {
                    $argument->setValue($argument->getDefaultValue());
                } else {
                    $sender->sendMessage($this->getUsage());
                    return;
                }
            }
            if (!$argument->verify($sender)) {
                $sender->sendMessage($argument->getErrorMessage());
                return;
            }
            $arguments->addArgument($argument);
        }
        $arguments->setUnProcessedArguments($args);
        $this->onRun($sender,$commandLabel,$arguments);
    }

    public abstract function prepare(): void;

    public abstract function onRun(CommandSender $sender, string $alias, Arguments $arguments);
}
