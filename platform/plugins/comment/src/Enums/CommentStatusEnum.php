<?php

namespace Botble\Comment\Enums;

use Botble\Base\Supports\Enum;
use Html;

/**
 * @method static CommentStatusEnum PENDING()
 * @method static CommentStatusEnum REJECTED()
 * * @method static CommentStatusEnum APPROVED()
 */
class CommentStatusEnum extends Enum
{
    public const PENDING = 'pending';
    public const REJECTED = 'rejected';
    public const APPROVED = 'approved';

    /**
     * @var string
     */
    public static $langPath = 'plugins/comment::comment.statuses';

    /**
     * @return string
     */
    public function toHtml()
    {
        switch ($this->value) {
            case self::PENDING:
                return Html::tag('span', self::PENDING()->label(), ['class' => 'label-info status-label'])
                    ->toHtml();
            case self::REJECTED:
                return Html::tag('span', self::REJECTED()->label(), ['class' => 'label-warning status-label'])
                    ->toHtml();
            case self::APPROVED:
                return Html::tag('span', self::APPROVED()->label(), ['class' => 'label-success status-label'])
                    ->toHtml();
            default:
                return parent::toHtml();
        }
    }
}
