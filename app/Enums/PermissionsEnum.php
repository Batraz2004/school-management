<?php

namespace App\Enums;

enum PermissionsEnum: string{
    case viewUser = 'view user';
    case viewAnyUser = 'viewAny user';
    case updateUser = 'update user';
    case createUser = 'create user';
    case deleteUser = 'delete user';
    case deleteForceUser = 'delete-force user';
}