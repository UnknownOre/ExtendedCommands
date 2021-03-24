<?php
namespace UnknownOre\ExtendedCommands\types\arguments;

class Arguments{
    /** @var Argument[] */
    private $arguments = [];
    private $unProcessed = [];

    public function getArgument(string $argument): ?Argument{
        return $this->arguments[$argument] ?? null;
    }


    public function setUnProcessedArguments(array $arguments){
        $this->unProcessed = $arguments;
    }

    public function getUnProcessedArguments(): array {
        return $this->unProcessed;
    }

    public function getArguments(): array {
        return $this->arguments;
    }

    public function addArgument(Argument $argument){
        $this->arguments[$argument->getName()] = $argument;
    }

}