<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use App\Models\Image;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LamController extends Controller
{
    public function y1()
    {
        //lấy comment bài viêt
        $article = Article::find(1);
        $comment_article = $article->comments;

    }
    public function y2()
    {

        //lấy comment video
        $video = Video::find(1);
        $comment_video = $video->ratings;
    }
    public function y3()
    {

        //lấy tất cả bình luận 1 người
        $user = User::query()->with('comments')->find(1);

        $comment_user = $user->comments;

    }
    public function y4()
    {
        //lấy trung bình đánh giá 1 bài viết
        $article = Article::find(2);
        $rating_article = $article->ratings()->avg('rating');
        dd($rating_article);
    }
    public function y5($user_id)
    {
        $comment_user = Comment::query()->where('user_id', $user_id)->get();

        //video
        $video = $comment_user->filter(fn($value, $key) => $value['commentable_type'] == 'App\Models\Video');

        //image
        $image = $comment_user->filter(fn($value, $key) => $value['commentable_type'] == 'App\Models\Image');

        //article
        $article = $comment_user->filter(fn($value, $key) => $value['commentable_type'] == 'App\Models\Article');
        dd($image->toArray());
    }
    public function y6()
    {
        $topRatedArticles = Article::with([
            'ratings' => function ($query) {
                $query->select(DB::raw('rateable_id, AVG(rating) as average_rating'))
                    ->groupBy('rateable_id')
                    ->orderBy('average_rating', 'desc')
                    ->take(5);
            }
        ])
            ->get();
    }

}
