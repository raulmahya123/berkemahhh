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
                    <input type="hidden" name="id" id="id" />
                    <input
                        type="hidden"
                        name="course_keypoint_id"
                        id="course_keypoint_id"
                    />
                    <div class="mb-3">
                        <label for="comment">Comment</label>
                        <input
                            type="text"
                            name="body"
                            id="body"
                            class="form-control"
                        />
                        <span class="invalid-feedback" id="error-name"></span>
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
