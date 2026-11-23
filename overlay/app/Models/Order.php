<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public const STATUS_PENDING      = 'pending';
    public const STATUS_UNDER_REVIEW = 'under_review';
    public const STATUS_APPROVED     = 'approved';
    public const STATUS_DISBURSED    = 'disbursed';
    public const STATUS_REJECTED     = 'rejected';

    /** Every status the board understands (reused later by API validation). */
    public const STATUSES = [
        self::STATUS_PENDING,
        self::STATUS_UNDER_REVIEW,
        self::STATUS_APPROVED,
        self::STATUS_DISBURSED,
        self::STATUS_REJECTED,
    ];

    protected $fillable = [
        'customer_name',
        'amount',
        'status',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];
}
