<x-layout>
    <x-slot name="title">Blog</x-slot>

    <img class="headerImg" src="{{ asset('blog.png') }}" alt="Blog">

    <section id="blog-pane">
        <div class="section-header">
            <h1>Blog</h1>
        </div>
        <x-blog-post-view :posts="$posts" />
    </section>
    <div class="button-row">
        @if (request()->get('tag') != null)
            <button class="btn btn-secondary" type="button" onclick="window.location.href='/blog'">
                Clear Tag
            </button>
        @endif
        @admin
            @if (request()->get('all') == null && $posts->where('is_draft', true)->count() > 0)
                <button class="btn btn-secondary" type="button" onclick="window.location.href='/blog?all=1'">
                    View All
                </button>
            @elseif (request()->get('all') == 1)
                <button class="btn btn-secondary" type="button" onclick="window.location.href='/blog'">
                    View Published
                </button>
            @endif
            @if (request()->get('drafts') == 1)
                <button class="btn btn-secondary" type="button" onclick="window.location.href='/blog'">
                    View Published
                </button>
            @elseif ($posts->draft_count > 0)
                <button class="btn btn-secondary" type="button" onclick="window.location.href='/blog?drafts=1'">
                    View Drafts
                </button>
            @endif
            <button class="btn btn-primary" type="button" onclick="window.location.href='/blog/create'">
                + Create Post
            </button>
        @endadmin
    </div>
</x-layout>
