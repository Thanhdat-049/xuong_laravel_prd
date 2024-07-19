<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use App\Models\Image;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function getArticleComments($articleId)
    {
        $article = Article::findOrFail($articleId);
        $comments = $article->comments()->get();

        return response()->json(['comments' => $comments]);
    }
    public function getVideoRatings($videoId)
    {
        $video = Video::findOrFail($videoId);
        $ratings = $video->ratings()->get();

        return response()->json(['ratings' => $ratings]);
    }

    public function getUserComments($userId)
    {
        $user = User::findOrFail($userId);
        $comments = Comment::where('user_id', $userId)
            ->get();

        return response()->json(['comments' => $comments]);
    }
    public function getAverageRatingForArticle($articleId)
    {
        $article = Article::findOrFail($articleId);
        $averageRating = $article->ratings()->avg('rating');

        return response()->json(['average_rating' => $averageRating]);
    }

    public function getItemsCommentedByUser($userId)
    {
        $user = User::findOrFail($userId);

        // Lấy tất cả các bài viết được bình luận bởi người dùng
        $articles = Article::whereHas('comments', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->get();

        // Lấy tất cả các video được bình luận bởi người dùng
        $videos = Video::whereHas('comments', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->get();

        // Lấy tất cả các hình ảnh được bình luận bởi người dùng
        $images = Image::whereHas('comments', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->get();

        return response()->json([
            'articles' => $articles,
            'videos' => $videos,
            'images' => $images,
        ]);
    }


    public function getTopRatedItems()
    {
        // Lấy top 5 bài viết có đánh giá trung bình cao nhất
        $topRatedArticles = Article::with([
            'ratings' => function ($query) {
                $query->select(DB::raw('rateable_id, AVG(rating) as average_rating'))
                    ->groupBy('rateable_id')
                    ->orderByDesc('average_rating')
                    ->take(5);
            }
        ])
            ->get();

        // Lấy top 5 video có đánh giá trung bình cao nhất
        $topRatedVideos = Video::with([
            'ratings' => function ($query) {
                $query->select(DB::raw('rateable_id, AVG(rating) as average_rating'))
                    ->groupBy('rateable_id')
                    ->orderByDesc('average_rating')
                    ->take(5);
            }
        ])
            ->get();

        // Lấy top 5 hình ảnh có đánh giá trung bình cao nhất
        $topRatedImages = Image::with([
            'ratings' => function ($query) {
                $query->select(DB::raw('rateable_id, AVG(rating) as average_rating'))
                    ->groupBy('rateable_id')
                    ->orderByDesc('average_rating')
                    ->take(5);
            }
        ])
            ->get();

        return response()->json([
            'top_rated_articles' => $topRatedArticles,
            'top_rated_videos' => $topRatedVideos,
            'top_rated_images' => $topRatedImages,
        ]);
    }
}
