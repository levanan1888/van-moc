<?php

namespace Botble\Comment\Forms;

use Assets;
use Botble\Base\Forms\FormAbstract;
use Botble\Comment\Enums\CommentStatusEnum;
use Botble\Comment\Http\Requests\EditCommentRequest;
use Botble\Comment\Models\Comment;

class CommentForm extends FormAbstract
{
    /**
     * {@inheritDoc}
     */
    public function buildForm()
    {
        Assets::addScriptsDirectly('vendor/core/plugins/comment/js/comment.js')
            ->addStylesDirectly('vendor/core/plugins/comment/css/comment.css');

        $this
            ->setupModel(new Comment())
            ->setValidatorClass(EditCommentRequest::class)
            ->withCustomFields()
            ->add('status', 'customSelect', [
                'label' => trans('core/base::tables.status'),
                'label_attr' => ['class' => 'control-label required'],
                'choices' => CommentStatusEnum::labels(),
            ])
            ->setBreakFieldPoint('status')
            ->addMetaBoxes([
                'information' => [
                    'title' => trans('plugins/comment::comment.comment_information'),
                    'content' => view('plugins/comment::comment-info', ['comment' => $this->getModel()])->render(),
                    'attributes' => [
                        'style' => 'margin-top: 0',
                    ],
                ],
                'replies' => [
                    'title' => trans('plugins/comment::comment.replies'),
                    'content' => view('plugins/comment::reply-box', ['comment' => $this->getModel()])->render(),
                ],
            ]);
    }
}
