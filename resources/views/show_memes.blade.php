<div class="container">
    <div class="mt-5 mb-4 text-center"><i>Check out the latest memes below:</i></div>

    <div class="d-flex flex-column align-items-center">
        @foreach ($memes as $meme)
            <div class="card mb-3">
                <img src="{{ asset('storage/' . $meme->imgurl) }}" class="card-img-top img-fluid" alt="Meme Image">
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
                                        <button type="submit"
                                            class="btn btn-outline-warning btn-sm custom-button"><span
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
                    <div class="text-center mt-3">
                        <button class="btn comment-button"
                            onclick="window.location.href = '{{ route('meme', ['id' => $meme->id]) }}';">View
                            Comments</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
