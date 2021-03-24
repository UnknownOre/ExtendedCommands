<?php


namespace UnknownOre\ExtendedCommands\types\arguments;


use pocketmine\command\CommandSender;

class FloatArgument extends Argument{

    const FLAG_MIN_VALUE = 0;
    const FLAG_MAX_VALUE = 1;

    public function getErrorMessage(): string{
        $value = $this->getValue();

        if(!is_numeric($value)){
            return $value." isn't a valid number.";
        }

        $flags = $this->getFlags();

        if(isset($flags[self::FLAG_MIN_VALUE])){
            if($value < $min = $flags[self::FLAG_MIN_VALUE]){
                return $this->getName()." should be higher than ".$min.".";
            }
        }

        if(isset($flags[self::FLAG_MAX_VALUE])){
            if($value > $max = $flags[self::FLAG_MAX_VALUE]){
                return $this->getName()." should be less than ".$max.".";
            }
        }

        return "";
    }

    public function verify(CommandSender $sender): bool{
        $value = $this->getValue();

        if(!is_numeric($value)){
            return false;
        }

        $flags = $this->getFlags();

        if(isset($flags[self::FLAG_MIN_VALUE])){
            if($value < $flags[self::FLAG_MIN_VALUE]){
                return false;
            }
        }

        if(isset($flags[self::FLAG_MAX_VALUE])){
            if($value > $flags[self::FLAG_MAX_VALUE]){
                return false;
            }
        }
        $this->setValue((float) $value);
        return true;
    }

}