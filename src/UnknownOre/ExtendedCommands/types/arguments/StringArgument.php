<?php


namespace UnknownOre\ExtendedCommands\types\arguments;


use pocketmine\command\CommandSender;

class StringArgument extends Argument{

    const FLAG_MIN_LENGTH = 0;
    const FLAG_MAX_LENGTH = 1;

    public function getErrorMessage(): string{
        $value = strlen($this->getValue());
        $flags = $this->getFlags();

        if(isset($flags[self::FLAG_MIN_LENGTH])){
            if($value < $min = $flags[self::FLAG_MIN_LENGTH]){
                return $this->getName()." should be higher than ".$min." characters in length.";
            }
        }

        if(isset($flags[self::FLAG_MAX_LENGTH])){
            if($value > $max = $flags[self::FLAG_MAX_LENGTH]){
                return $this->getName()." should be less than ".$max." characters in length.";
            }
        }

        return "";
    }

    public function verify(CommandSender $sender): bool{
        $value = strlen($this->getValue());
        $flags = $this->getFlags();

        if(isset($flags[self::FLAG_MIN_LENGTH])){
            if($value < $flags[self::FLAG_MIN_LENGTH]){
                return false;
            }
        }

        if(isset($flags[self::FLAG_MAX_LENGTH])){
            if($value > $flags[self::FLAG_MAX_LENGTH]){
                return false;
            }
        }

        return true;
    }

}