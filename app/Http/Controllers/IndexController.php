<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Auth;

class IndexController extends Controller
{
    public function home()
    {
        $posts = BlogPost::where('is_draft', false)->whereDoesntHave('tags', function ($query) {
            $query->where('name', 'featured');
        })->orderByDesc('published_at')->take(6)->get();
        $featured_posts = BlogPost::where('is_draft', false)->whereHas('tags', function ($query) {
            $query->where('name', 'featured');
        })->orderByDesc('published_at')->get();

        $posts = $featured_posts->merge($posts);

        $socials = new SocialController();
        $social_posts = $socials->buildFeed();

        if (env('APP_ENV') === 'production') {
            if (auth()->check() && Auth::user()?->isAdmin()) {
                return view('welcome', compact('posts', 'social_posts'));
            } else {
                return redirect('https://thegreenasterisk.netlify.app/');
            }
        } else {
            return view('welcome', compact('posts', 'social_posts'));
        }
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }

    public function privacy()
    {
        return view('privacy');
    }

    public function tos()
    {
        return view('tos');
    }

    public function deleteFbData()
    {
        return view('delete-fb-data');
    }
}
