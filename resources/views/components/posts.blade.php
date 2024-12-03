<div class="w3l-homeblock2 w3l-homeblock6 py-2">
    <div class="container px-sm-5 py-lg-5 py-md-4">
        <div class="left-right">
            <h3 class="section-title-left mb-sm-4 mb-2">{{ $category->name }}</h3>
            <a href="{{ route('topics', ['category' => $category->slug]) }}"
               class="more btn btn-small mb-sm-0 mb-4">
                View more
            </a>
        </div>

        <div class="row">
            @foreach($category->posts->take(4) as $post)
                <div class="col-lg-6 mt-4">
                    <div class="bg-clr-white hover-box">
                        <div class="row">
                            <div class="col-sm-6 position-relative">
                                <a href="{{ route('post.show', ['post' => $post->id]) }}" class="image-mobile">
                                    <div style="width: 100%; padding-bottom: 100%; position: relative; overflow: hidden;">
                                        @if($post->image)
                                            <img class="card-img-bottom d-block radius-image-full"
                                                 src="{{ Storage::url($post->image) }}"
                                                 alt="Card image cap"
                                                 id="image-preview"
                                                 style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;">
                                        @else
                                            <img class="card-img-bottom d-block radius-image-full"
                                                 src="{{ asset('assets/images/empty.png') }}"
                                                 alt="Card image cap"
                                                 style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;">
                                        @endif
                                    </div>
                                </a>
                            </div>
                            <div class="col-sm-6  card-body blog-details align-self py-2">

                                <span class="label-blue">
                                    <a href="{{ route('posts', ['topic' => $post->topic->id]) }}">
                                        {{$post->topic->name}}
                                    </a>
                                </span>
                                <a href="{{ route('post.show', ['post' => $post->id]) }}" class="blog-desc ">
                                    {{ Str::limit($post->title, 60) }}
                                </a>

                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
