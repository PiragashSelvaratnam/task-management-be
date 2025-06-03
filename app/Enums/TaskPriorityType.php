<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static LOW()
 * @method static static MEDIUM()
 * @method static static HIGH()
 */
final class TaskPriorityType extends Enum
{
    const LOW = 'low';
    const MEDIUM = "medium";
    const HIGH = 'high';
}
