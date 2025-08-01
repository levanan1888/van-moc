<?php

namespace Botble\Comment\Http\Controllers;

use Botble\Base\Events\BeforeEditContentEvent;
use Botble\Base\Forms\FormBuilder;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Base\Traits\HasDeleteManyItemsTrait;
use Botble\Comment\Enums\CommentStatusEnum;
use Botble\Comment\Forms\CommentForm;
use Botble\Comment\Http\Requests\CommentReplyRequest;
use Botble\Comment\Http\Requests\EditContactRequest;
use Botble\Comment\Repositories\Interfaces\CommentReplyInterface;
use Botble\Comment\Tables\CommentTable;
use Botble\Comment\Repositories\Interfaces\CommentInterface;
use EmailHandler;
use Exception;
use Illuminate\Http\Request;
use Botble\Base\Events\DeletedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;

class CommentController extends BaseController
{
    use HasDeleteManyItemsTrait;

    /**
     * @var CommentInterface
     */
    protected $commentRepository;

    /**
     * @param CommentInterface $commentRepository
     */
    public function __construct(CommentInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    /**
     * @param CommentTable $dataTable
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function index(CommentTable $dataTable)
    {
        page_title()->setTitle(trans('plugins/comment::comment.menu'));

        return $dataTable->renderTable();
    }

    /**
     * @param $id
     * @param FormBuilder $formBuilder
     * @param Request $request
     * @return string
     */
    public function edit($id, FormBuilder $formBuilder, Request $request)
    {
        page_title()->setTitle(trans('plugins/comment::comment.edit'));

        $comment = $this->commentRepository->findOrFail($id, ['post']);

        event(new BeforeEditContentEvent($request, $comment));

        return $formBuilder->create(CommentForm::class, ['model' => $comment])->renderForm();
    }

    /**
     * @param $id
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function update($id, EditCommentRequest $request, BaseHttpResponse $response)
    {
        $comment = $this->commentRepository->findOrFail($id);

        $comment->fill($request->input());

        $this->commentRepository->createOrUpdate($comment);

        event(new UpdatedContentEvent(COMMENT_MODULE_SCREEN_NAME, $request, $comment));

        return $response
            ->setPreviousUrl(route('comments.index'))
            ->setMessage(trans('core/base::notices.update_success_message'));
    }

    /**
     * @param $id
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function destroy($id, Request $request, BaseHttpResponse $response)
    {
        try {
            $comment = $this->commentRepository->findOrFail($id);
            $this->commentRepository->delete($comment);
            event(new DeletedContentEvent(COMMENT_MODULE_SCREEN_NAME, $request, $contact));

            return $response->setMessage(trans('core/base::notices.delete_success_message'));
        } catch (Exception $exception) {
            return $response
                ->setError()
                ->setMessage($exception->getMessage());
        }
    }

    /**
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     * @throws Exception
     */
    public function deletes(Request $request, BaseHttpResponse $response)
    {
        return $this->executeDeleteItems($request, $response, $this->commentRepository, COMMENT_MODULE_SCREEN_NAME);
    }

    /**
     * @param int $id
     * @param CommentReplyRequest $request
     * @param BaseHttpResponse $response
     * @param CommentReplyRequest $commentReplyRepository
     * @return BaseHttpResponse
     */
    public function postReply(
        $id,
        CommentReplyRequest $request,
        BaseHttpResponse $response,
        CommentReplyInterface $commentReplyRepository
    ) {
        // $comment = $this->commentRepository->findOrFail($id);

        // EmailHandler::send($request->input('message'), 'Re: ' . $comment->content, $comment->email);

        // $commentReplyRepository->create([
        //     'message' => $request->input('message'),
        //     'contact_id' => $id,
        // ]);

        // $contact->status = ContactStatusEnum::READ();
        // $this->contactRepository->createOrUpdate($contact);

        // return $response
        //     ->setMessage(trans('plugins/contact::contact.message_sent_success'));
    }
}
