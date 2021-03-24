<?php
namespace UnknownOre\ExtendedCommands\types\requirements;


use pocketmine\command\CommandSender;

abstract class Requirement{

    public abstract function verify(CommandSender $sender): bool;

    public abstract function getErrorMessage(): string;

}