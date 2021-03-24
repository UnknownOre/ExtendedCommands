<?php


namespace UnknownOre\ExtendedCommands\types\arguments;


use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\Server;

class PlayerArgument extends Argument {

    const FLAG_SELF = 0;

    public function verify(CommandSender $sender): bool{
        $value = $this->getValue();
        $flags = $this->getFlags();
        if(isset($flags[self::FLAG_SELF])){
            $this->setValue($sender);
            return true;
        }

        $player = Server::getInstance()->getPlayer($value);

        return $player instanceof Player;
    }

    public function getErrorMessage(): string{
        return "Player with the name ".$this->getValue()." wasn't found";
    }

}