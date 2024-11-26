<div
    class="modal fade"
    id="commentModal"
    tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">
                <form id="editCommentForm">
                    <input type="hidden" name="slug" id="slug" />
                    <input type="hidden" name="course_id" id="course_id" />
                    <div class="mb-3">
                        <label for="course_video_id">Title</label>
                        <select
                            class="form-select course_video_id"
                            name="course_video_id"
                            id="edit_course_video_id"
                        >
                            @foreach ($courseVideos as $video)
                            @if(old('course_video_id') == $video->id)
                            <option value="{{ $video->id }}" selected>
                                {{ $video->name }}
                            </option>
                            @else
                            <option value="{{ $video->id }}">
                                {{ $video->name }}
                            </option>
                            @endif @endforeach
                        </select>
                        <span
                            class="invalid-feedback"
                            id="error-course_video_id"
                        ></span>
                    </div>
                    <div class="mb-3">
                        <label for="body">Comment</label>
                        <input
                            type="text"
                            name="body"
                            id="body"
                            class="form-control"
                        />
                        <span class="invalid-feedback" id="error-body"></span>
                    </div>

                    <div class="float-end">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal"
                        >
                            Close
                        </button>
                        <button
                            type="submit"
                            class="btn btn-primary btnSubmit"
                        ></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
