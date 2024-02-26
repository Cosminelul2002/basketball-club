<?php

namespace App\Enums;

use Codestage\Authorization\Contracts\IPermissionEnum;

enum Permission: string implements IPermissionEnum
{
    case CreatePlayer = 'players.create';
    case ReadPlayer = 'players.read';
    case UpdatePlayer = 'players.update';
    case DeletePlayer = 'players.delete';

    case CreateParent = 'parents.create';
    case ReadParent = 'parents.read';
    case UpdateParent = 'parents.update';
    case DeleteParent = 'parents.delete';

    case ViewPlayerProfile = 'player_profile.view';

    case ViewAdminProfile = 'admin_profile.view';

    case ViewParentProfile = 'parent_profile.view';
}
