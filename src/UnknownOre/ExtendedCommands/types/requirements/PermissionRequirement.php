<?php


namespace UnknownOre\ExtendedCommands\types\requirements;


use pocketmine\command\CommandSender;

class PermissionRequirement extends Requirement{

    private $permission;

    public function __construct(string $permission){
        $this->permission = $permission;
    }

    public function verify(CommandSender $sender): bool{
        return $sender->hasPermission($this->permission);
    }

    public function getErrorMessage(): string{
        return "You don't have permission to execute this command.";
    }

}