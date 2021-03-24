<?php


namespace UnknownOre\ExtendedCommands\types\arguments;


use pocketmine\command\CommandSender;

abstract class Argument{

    private $name;
    private $value;
    private $defaultValue;
    private $flags = [];

    public function __construct(string $name){
        $this->name = $name;
    }

    public function setFlag(int $flag, $value){
        $this->flags[$flag] = $value;
    }

    public function getFlags(): array {
        return $this->flags;
    }

    public function setDefaultValue($value){
        $this->defaultValue = $value;
    }

    public function getDefaultValue(){
        return $this->defaultValue;
    }

    public function isDefaultSet(): bool {
        return $this->defaultValue !== null;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getValue(){
        return $this->value;
    }

    public function setValue($value){
        $this->value = $value;
    }

    public abstract function verify(CommandSender $sender): bool;

    public abstract function getErrorMessage(): string;
}