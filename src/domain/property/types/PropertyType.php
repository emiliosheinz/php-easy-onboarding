<?php

declare(strict_types=1);

namespace App\Domain\Property\Types;

enum PropertyType: string
{
    case Hotel = 'hotel';
    case Hostel = 'hostel';
    case Boutique = 'boutique';
    case Motel = 'motel';
    case VacationRental = 'vacationRental';
    case BedAndBreakfast = 'bedAndBreakfast';
    case Campground = 'campground';
    case OutdoorLodge = 'outdoorLodge';
}
