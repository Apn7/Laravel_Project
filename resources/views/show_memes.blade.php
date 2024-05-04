
<div class="container">
    <div class="mt-5 text-center">Check out the latest memes below:</div>

    <div class="d-flex flex-column align-items-center">
        @foreach ($memes as $meme)
            <div class="card mb-3">
                <img src="{{ asset('storage/' . $meme->imgurl) }}" class="card-img-top img-fluid"
                    style="max-width: 100%; height: auto;" alt="Meme Image">
                <div class="card-body">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <span>Uploaded By: <a
                                            href="{{ route('profile', ['username' => $meme->user->username]) }}">{{ $meme->user->username }}
                                        </a></span>
                                </div>
                                @if ($meme->user->id == Auth::id())
                                    <div>
                                        <form id="deleteMemeForm" action="{{ route('deleteMeme') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="meme_id" value="{{ $meme->id }}">
                                            <i id="deleteMemeIcon" class="ri-delete-bin-6-line custom-icon"
                                                onclick="memeDeleteForm()" style="cursor: pointer;"></i>
                                        </form>
                                    </div>
                                @endif
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div style="max-width: 25rem">
                                    <span>{{ $meme->description }}</span>
                                </div>
                                @if ($meme->user->id == Auth::id())
                                    <div>

                                        <form id="editMemeForm" action="{{ route('editMemeView', ['id' => $meme->id]) }}"
                                            method="get">
                                            @csrf
                                            <input type="hidden" name="meme_id" value="{{ $meme->id }}">
                                            <i id="editMemeIcon" class="ri-edit-line custom-icon"
                                                onclick="memeEditForm()" style="cursor: pointer;"></i>
                                        </form>
                                    </div>
                                @endif
                            </div>
                            <!-- Like Button -->
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    @if (Auth::check())
                                        <form action="{{ route('like') }}" method="post" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="meme_id" value="{{ $meme->id }}">
                                            <button type="submit" class="btn btn-outline-warning"
                                                style="padding: 5px 10px; border-radius: 20px;"><span
                                                    style="font-size: 1.2em;">😆</span></button>
                                        </form>
                                    @endif
                                    <!-- Total Likes -->
                                    <span class="ms-2"><i class="bi bi-heart-fill"></i>
                                        <strong>{{ $meme->likes()->count() }}</strong> Hahas</span>
                                </div>
                                <div>
                                    <span style="font-size: 0.7em">Uploaded On: {{ $meme->created_at->format('M d, Y h:i A') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Comment Section -->

                    <div class="comments">
                        @foreach ($meme->comments as $comment)
                            <div class="comment card mb-3">
                                <div class="card-body">
                                    <p class="card-text">{{ $comment->content }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <span>By: <a
                                                    href="{{ route('profile', ['username' => $comment->user->username]) }}">
                                                    {{ $comment->user->username }}</a></span>
                                        </div>
                                        @if ($comment->user->id == Auth::id())
                                            <div>
                                                <form id="deleteCommentForm" action="{{ route('deleteComment') }}"
                                                    method="post">
                                                    @csrf
                                                    <input type="hidden" name="comment_id"
                                                        value="{{ $comment->id }}">
                                                    <i id="deleteMemeIcon" class="ri-delete-bin-6-line"
                                                        onclick="commentDeleteForm()"
                                                        style="cursor: pointer; color: red"></i>
                                                </form>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <!-- Comment Form -->
                        @if (Auth::check())
                            <div class="card mb-3">
                                <div class="card-body">
                                    <form action="{{ route('comment') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="meme_id" value="{{ $meme->id }}">
                                        <textarea name="content" rows="3" class="form-control mb-2" placeholder="Write a comment"></textarea>
                                        <button type="submit" class="btn btn-outline-dark"
                                            style="padding: 5px 15px; border-radius: 20px;">Comment</button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        @endforeach
    </div>
</div>


