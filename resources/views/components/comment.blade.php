<div class="  mt-4 form-inner-cont">
    <div class="bg-clr-white hover-box">
        <div class="col-sm-12 card-body blog-details align-self ml-2">
            <form action="{{ route('add.comment', ['postId' => $post]) }}" method="post">
                @csrf
                <div class="form-input">
                    <textarea name="comment" id="w3lMessage" placeholder="Add your comment here"
                              class="@error('comment') is-invalid @enderror"></textarea>

                    @error('comment')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <input  value ="{{Auth::user()->id}}" name ="author_id" type="hidden">
                    <input  value ="" name ="response_id" type="hidden">
                </div>

                <div class="text-right">
                    <button type="submit" class="btn btn-style btn-primary">Send</button>
                </div>
            </form>
        </div>
    </div>
</div>
