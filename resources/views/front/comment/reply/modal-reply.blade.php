<div
    class="modal fade"
    id="replyModal"
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
                <form id="editReplyForm">
                    <input type="hidden" name="slug" id="slug" />
                    <input type="hidden" name="comment_id" id="comment_id" />
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
