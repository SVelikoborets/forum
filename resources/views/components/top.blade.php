
<div class="w3l-homeblock3 py-5">
    <div class="container py-lg-5 py-md-4">
        <h3 class="section-title-left mb-4"> Top Post's </h3>
        <div class="row justify-content-around">
            @if(count($top)>0)
                @foreach($top as $post)

                    <div class="col-lg-4 col-md-6 mt-md-0 mt-4">
                        <div class="top-pic1">

                            @if($post->image)
                                <img src="{{ Storage::url($post->image) }}"
                                     alt="Post Image"
                                     class="img-fluid radius-image-full " >
                            @else
                                <img src="{{ asset('assets/images/empty.png') }}"
                                     alt="No Image"
                                     class="img-fluid radius-image-full">
                            @endif

                            <div class="card-body blog-details">
                                <a href="{{ route('post.show', ['post' => $post->id]) }}" class="blog-desc">
                                    {{ $post->title }}
                                </a>
                                <div class="author align-items-center">
                                    @if($post->user->avatar)
                                        <img src="{{ Storage::url($post->user->avatar) }}"
                                             class="img-fluid rounded-circle"
                                             alt="Avatar" >
                                    @else
                                        <img src="{{ asset('assets/images/avatar.png') }}"
                                             class="img-fluid rounded-circle"
                                             alt="Avatar">
                                    @endif
                                    <ul class="blog-meta">
                                        <li>
                                            <a href="{{ route('profile', ['user' => $post->user->id]) }}">
                                                {{ $post->user->name }}
                                            </a>
                                        </li>
                                        <li class="meta-item blog-lesson">
                                            <span class="meta-value"> {{ $post->created_at->format('d.m.Y') }} </span>.
                                            <span class="meta-value ml-2"><span class="fa fa-clock-o"></span> 1 min</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>