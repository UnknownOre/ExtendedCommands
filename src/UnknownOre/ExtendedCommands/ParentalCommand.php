<?php


namespace UnknownOre\ExtendedCommands;


use UnknownOre\ExtendedCommands\types\arguments\Arguments;
use UnknownOre\ExtendedCommands\types\arguments\StringArgument;
use pocketmine\command\CommandSender;

abstract class ParentalCommand extends CustomCommand{

    public function __construct(string $name, string $description = "", string $usageMessage = null, array $aliases = []){
        $this->mainArgument = new StringArgument("action");
        $this->addArgument($this->mainArgument);
        parent::__construct($name, $description, $usageMessage, $aliases);
    }

    /** @var CustomCommand[] */
    private $subCommands = [];
    private $mainArgument;

    public function getSubCommands(): array{
        return $this->subCommands;
    }

    public function addSubCommand(CustomCommand $command){
        $this->subCommands[strtolower($command->getName())] = $command;
    }

    public function findSubCommand(string $command): ?CustomCommand{
        foreach ($this->subCommands as $subCommand) {
            if (strcasecmp($subCommand->getName(), $command) == 0) {
                return $subCommand;
            }
            if (in_array($command, $subCommand->getAliases())) {
                return $subCommand;
            }
        }
        return null;
    }

    public function onRun(CommandSender $sender, string $alias, Arguments $arguments){
        $subCommand = $arguments->getArgument("action")->getValue();
        $subCommand = $this->findSubCommand($subCommand);
        if ($subCommand instanceof CustomCommand) {
            $subCommand->execute($sender, $alias, $arguments->getUnProcessedArguments());
        } else {
            $sender->sendMessage($this->getUsage());
        }
    }

}