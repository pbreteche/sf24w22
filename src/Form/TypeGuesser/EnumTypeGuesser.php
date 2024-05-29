<?php

namespace App\Form\TypeGuesser;

use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\FormTypeGuesserInterface;
use Symfony\Component\Form\Guess;

class EnumTypeGuesser implements FormTypeGuesserInterface
{
    public function guessType(string $class, string $property): ?Guess\TypeGuess
    {
        if (!class_exists($class) || !property_exists($class, $property)) {
            return null;
        }

        $ref = new \ReflectionProperty($class, $property);
        $type = $ref->getType();

        if (!$type instanceof \ReflectionNamedType) {
            return null;
        }

        $typeName = $type->getName();

        if (enum_exists($typeName)) {
            return new Guess\TypeGuess(EnumType::class, [
                'class' => $type->getName(),
                'placeholder' => '--',
            ], Guess\Guess::VERY_HIGH_CONFIDENCE);
        }

        if (class_exists($typeName) && str_starts_with($typeName, 'App\\Entity\\')) {
            $formTypeName = str_replace('Entity', 'Form', $typeName).'Type';
            if (class_exists($formTypeName)) {
                return new Guess\TypeGuess($formTypeName, [], Guess\Guess::HIGH_CONFIDENCE);
            }
        }

        return null;
    }

    public function guessRequired(string $class, string $property): ?Guess\ValueGuess
    {
        return null;
    }

    public function guessMaxLength(string $class, string $property): ?Guess\ValueGuess
    {
        return null;
    }

    public function guessPattern(string $class, string $property): ?Guess\ValueGuess
    {
        return null;
    }
}
