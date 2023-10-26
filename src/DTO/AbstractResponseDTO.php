<?php

namespace App\DTO;

abstract class AbstractResponseDTO
{
    abstract function serialize(): array;
}