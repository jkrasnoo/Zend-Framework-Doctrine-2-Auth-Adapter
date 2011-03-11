<?php
namespace BadWolf\Doctrine\Dbal\Types;

use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;

class IpAddress extends Type
{
    const IP_ADDRESS = 'ipaddress';

    public function getSqlDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return $platform->getIntegerTypeDeclarationSQL($fieldDeclaration);
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return \long2ip($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return \sprintf('%u', \ip2long($value));
    }

    public function getName()
    {
        return self::IP_ADDRESS; // modify to match your constant name
    }

}