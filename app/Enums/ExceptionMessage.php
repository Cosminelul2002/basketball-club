<?php

namespace App\Enums;

class ExceptionMessage
{
    public static function GeneralError(): string
    {
        return "An error occurred.";
    }

    public static function GeneralResourceError(): string
    {
        return "An error occurred while processing the resource.";
    }

    public static function GeneralStoreResourceError(): string
    {
        return "An error occurred while storing the resource.";
    }

    public static function GeneralUpdateResourceError(): string
    {
        return "An error occurred while updating the resource.";
    }

    public static function ResourceNotFound(string $resource): string
    {
        return "The resource '{$resource}' was not found.";
    }

    public static function ResourceAssociatedNotFound(string $resource): string
    {
        return "The associated resource for the '{$resource}' was not found.";
    }

    public static function DeleteResourceError(string $resource): string
    {
        return "An error occurred while deleting the '{$resource}'.";
    }

    public static function QueryFailed(string $resource): string
    {
        return "The query for the '{$resource}' failed.";
    }
}
