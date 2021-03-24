<?php


namespace UnknownOre\ExtendedCommands\types\requirements;


use pocketmine\command\CommandSender;
use pocketmine\Player;

class PlayerRequirement extends Requirement{

    public function getErrorMessage(): string{
        return "Please run this command in-game.";
    }

    public function verify(CommandSender $sender): bool{
        return $sender instanceof Player;
    }

}