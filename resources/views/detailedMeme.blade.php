<div class="container mt-5">

    <div class="d-flex flex-column align-items-center">
        {{-- @foreach ($memes as $meme) --}}
        <div class="card mb-3">
            <img src="{{ asset('storage/' . $meme->imgurl) }}" class="card-img-top img-fluid"
                style="max-width: 100%; height: auto;" alt="Meme Image">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="tags">
                        @if ($meme->tags)
                            @foreach (explode(',', $meme->tags) as $tag)
                                <a href="/?tag={{ $tag }}" class="tag-pill">{{ $tag }}</a>
                            @endforeach
                        @endif
                    </div>
                    @if ($meme->user->id == Auth::id())
                        <div class="edit-delete-icons">
                            <a href="{{ route('editMemeView', ['id' => $meme->id]) }}"
                                class="btn btn-sm btn-outline-secondary"><i class="ri-edit-line"></i></a>
                            <button onclick="document.getElementById('deleteMemeForm{{ $meme->id }}').submit();"
                                class="btn btn-sm btn-outline-danger"><i class="ri-delete-bin-6-line"></i></button>
                            <form id="deleteMemeForm{{ $meme->id }}" action="{{ route('deleteMeme') }}"
                                method="post" style="display: none;">
                                @csrf
                                <input type="hidden" name="meme_id" value="{{ $meme->id }}">
                            </form>
                        </div>
                    @else
                        <!-- Ensure users cannot report their own memes -->
                        <form id="reportMemeForm{{ $meme->id }}" action="{{ route('report') }}" method="get">
                            @csrf
                            <input type="hidden" name="meme_id" value="{{ $meme->id }}">
                            <button id="reportMemeIcon{{ $meme->id }}"
                                class="btn btn-sm btn-outline-danger custom-button" type="submit">
                                <i class="ri-flag-line"></i>
                            </button>
                        </form>
                    @endif
                </div>

                <p class="mt-2"><b>Uploaded By:</b> <strong> <a
                            href="{{ route('profile', ['username' => $meme->user->username]) }}"
                            class="uploaded-by">{{ $meme->user->username }}</a> </strong></p>
                <p>{{ $meme->description }}</p>
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        @if (Auth::check())
                            <form action="{{ route('like') }}" method="post" class="d-inline">
                                @csrf
                                <input type="hidden" name="meme_id" value="{{ $meme->id }}">
                                {{-- @if ($meme->likes()->where('user_id', Auth::id())->count() > 0) --}}
                                @if ($meme->is_liked())
                                    <button type="submit" class="btn btn-outline-warning btn-sm custom-button"><span
                                            style="font-size: 1.2em;">😆</span></button>
                                @else
                                    <button type="submit" class="btn btn-outline-warning btn-sm haha-emoji"><span
                                            style="font-size: 1.2em;">😆</span></button>
                                @endif
                            </form>
                        @endif
                        <span class="ms-2 likes-count"><i class="bi bi-heart-fill"></i>
                            <strong>{{ $meme->likes()->count() }}</strong> Hahas</span>
                    </div>
                    <div>
                        <span style="font-size: 0.7em;">Uploaded On:
                            {{ $meme->created_at->timezone('Asia/Dhaka')->format('M d, Y h:i A') }}</span>
                    </div>
                </div>

                <!-- Comment Section -->
                <div class="comments">
                    @foreach ($meme->comments as $comment)
                        <div class="comment card mb-3">
                            <div class="card-body">
                                <span class="date-info">{{ $comment->created_at->diffForHumans() }}</span>
                                <p class="card-text">{{ $comment->content }}</p>
                                <div class="user-info">
                                    By: <a href="{{ route('profile', ['username' => $comment->user->username]) }}">
                                        {{ $comment->user->username }}</a>
                                </div>
                                @if ($comment->user->id == Auth::id())
                                    <form id="deleteCommentForm{{ $comment->id }}"
                                        action="{{ route('deleteComment') }}" method="post"
                                        style="position: absolute; right: 10px; bottom: 10px;">
                                        @csrf
                                        <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                        <i class="ri-delete-bin-6-line delete-icon"
                                            onclick="commentDeleteForm({{ $comment->id }})"></i>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @endforeach
                    <!-- Comment Form -->
                    @if (Auth::check())
                        <div class="card comment-form mb-3">
                            <div class="card-body">
                                <form action="{{ route('comment') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="meme_id" value="{{ $meme->id }}">
                                    <textarea name="content" rows="3" class="form-control mb-2" placeholder="Write a comment"></textarea>
                                    <button type="submit" class="btn custom-button">Comment</button>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            {{-- @endforeach --}}
        </div>
    </div>
