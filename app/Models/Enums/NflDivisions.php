<?php

namespace App\Models\Enums;

// for php 8.1
// enum NflDivisions: string
// {
//     case NFC_NORTH = 'NFC North';
//     case NFC_SOUTH = 'NFC South';
//     case NFC_EAST = 'NFC East';
//     case NFC_WEST = 'NFC West';
//     case AFC_NORTH = 'AFC North';
//     case AFC_SOUTH = 'AFC South';
//     case AFC_EAST = 'AFC East';
//     case AFC_WEST = 'AFC West';
// }

abstract class NflDivisions
{
    const NFC_NORTH = 'NFC North';
    const NFC_SOUTH = 'NFC South';
    const NFC_EAST = 'NFC East';
    const NFC_WEST = 'NFC West';
    const AFC_NORTH = 'AFC North';
    const AFC_SOUTH = 'AFC South';
    const AFC_EAST = 'AFC East';
    const AFC_WEST = 'AFC West';
}
