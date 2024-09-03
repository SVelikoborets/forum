<div class="w3l-homeblock2 py-5">
    <div class="container py-lg-5 py-md-4">
        <div class="row">

            <div class="col-lg-4 trending mt-lg-0 mt-5">
                <div class="topics">
                    <h3 class="section-title-left mb-4"> My Topics</h3>
                    @if($topics)
                        <div class="mt-4 left-right bg-clr-white p-3">
                            <h3 class="section-title-left align-self pl-2 mb-sm-0 mb-3">Add topic</h3>
                            <a class="btn btn-style btn-primary" href="{{ route('topic.create') }}">
                                <span class="fa fa-plus"></span>
                            </a>
                        </div>
                        @foreach ($topics as $topic)
                            <div class="topics-list mt-3">
                                <div class="list1">
                                    <a href="{{ route('topic.edit', ['topic' => $topic->id]) }}">
                                        <span class="fa fa-edit"></span>
                                    </a>
                                    <a href="{{ route('posts', ['topic' => $topic->id]) }}">
                                        <h4>{{ $topic->name }}</h4>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                @if($topics->hasPages())
                    <div class="mt-md-4">
                        <ul class="site-pagination text-center">
                            @for ($i = 1; $i <= $topics->lastPage(); $i++)
                                <li>
                                    @if ($i === $topics->currentPage())
                                        <span class="page-numbers current">{{ $i }}</span>
                                    @else
                                        <a class="page-numbers"
                                           href="{{ $topics->appends(['post_page' => $posts->currentPage()])->url($i) }}">
                                            {{ $i }}
                                        </a>
                                    @endif
                                </li>
                            @endfor
                            @if ($topics->hasMorePages())
                                <li>
                                    <a class="next page-numbers"
                                       href="{{ $topics->appends(['post_page' => $posts->currentPage()])->nextPageUrl() }}">
                                        Next »
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                @endif
            </div>

            <div class="col-lg-8">
                <h3 class="section-title-left mb-4">Popular</h3>
                <div class="row">
                    @foreach($top as $post)
                        <div class="col-lg-6 col-md-6 mt-md-0 mt-sm-5 mt-4 mb-3"  >
                            <div class="card">
                                <div class="card-header p-0 position-relative" >
                                    <a href="{{ route('post.show', ['post' => $post->id]) }}">
                                        @if($post->image)
                                            <img src="{{ Storage::url($post->image) }}"
                                                 alt="Post Image"
                                                 class="card-img-bottom d-block radius-image-full " >
                                        @else
                                            <img src="{{ asset('assets/images/empty.png') }}"
                                                 alt="No Image"
                                                 class="card-img-bottom d-block radius-image-full">
                                        @endif
                                    </a>
                                </div>
                                <div class="card-body blog-details">
                                    <span class="label-blue  mb-4 ">
                                        <a href="{{ route('topics', ['category' => $post->category->slug]) }}">
                                            {{ $post->category->name }}
                                        </a>
                                   </span>
                                    <span class="label-blue  mb-4 ">
                                        <a href="{{ route('posts', ['topic' => $post->topic->id]) }}">
                                            {{ $post->topic->name }}
                                        </a>
                                   </span>
                                    <div class="ml-2">
                                        <a href="{{ route('post.show', ['post' => $post->id]) }}" class="blog-desc">
                                            {{ $post->title }}
                                        </a>
                                    </div>

                                    <div class="author align-items-center mt-3 mb-1">
                                        @if(Auth::user()->avatar)
                                            <img src="{{ Storage::url(Auth::user()->avatar) }}"
                                                 class="img-fluid rounded-circle"
                                                 alt="Avatar" >
                                        @else
                                            <img src="{{ asset('assets/images/avatar.png') }}"
                                                 class="img-fluid rounded-circle"
                                                 alt="Avatar" >
                                        @endif
                                        <ul class="blog-meta">
                                            <li>
                                                <a href="{{ route('home') }}">{{ Auth::user()->name }}</a>
                                            </li>
                                            <li class="meta-item blog-lesson">
                                                <span class="meta-value">
                                                    {{ $post->created_at->format('d.m.Y') }}
                                                </span>.
                                                <span class="meta-value ml-2">
                                                    <span class="fa fa-clock-o"></span> 1 min
                                                </span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="left-right bg-clr-white p-3">
                    <h3 class="section-title-left align-self mb-3">Create new post</h3>
                    <a class="btn btn-style btn-primary"
                       href="{{ route('post.create', ['step' => 'first']) }}">
                       <span class="fa fa-plus"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
