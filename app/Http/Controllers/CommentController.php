<?php

namespace App\Http\Controllers;

use App\Actions\Comment\CreateCommentAction;
use App\Actions\Comment\DeleteCommentAction;
use App\Actions\Comment\UpdateCommentAction;
use App\Http\Requests\CreateCommentRequest;
use App\Http\Requests\DeleteCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function create(
        Post $post,
        CreateCommentRequest $createCommentRequest,
        CreateCommentAction $createCommentAction
    ): RedirectResponse {
        $validatedData = $createCommentRequest->validated();
        $createCommentAction->execute($post, $validatedData);

        return redirect()->back()->with('success', 'Commented successfully');
    }
    public function update(
        Post $post,
        Comment $comment,
        UpdateCommentRequest $updateCommentRequest,
        UpdateCommentAction $updateCommentAction
    ): RedirectResponse {
        $validatedData = $updateCommentRequest->validated();
        $updateCommentAction->execute($comment, $validatedData);

        return redirect()->back()->with('success', 'Updated successfully');
    }

    public function destroy(
        Post $post,
        Comment $comment,
        DeleteCommentRequest $deleteCommentRequest,
        DeleteCommentAction $deleteCommentAction
    ): RedirectResponse {
        $deleteCommentAction->execute($comment);

        return redirect()->back()->with('success', 'Comment deleted successfully');
    }
}
