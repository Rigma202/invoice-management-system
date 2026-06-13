<div class="modal fade"
     id="editStaffModal"
     tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <h5>Edit Staff</h5>

                <button class="btn-close"
                        data-bs-dismiss="modal"></button>

            </div>

            <div class="modal-body">

                <form id="staffEditForm">

                    @csrf
                    @method('PUT')

                    <input type="hidden"
                           id="edit_staff_id">

                    <div class="mb-3">

                        <label>Name</label>

                        <input type="text"
                               id="edit_name"
                               name="name"
                               class="form-control">

                        <small id="edit_name_error"
                               class="text-danger"></small>

                    </div>

                    <div class="mb-3">

                        <label>Email</label>

                        <input type="email"
                               id="edit_email"
                               name="email"
                               class="form-control">

                        <small id="edit_email_error"
                               class="text-danger"></small>

                    </div>

                    <button type="submit"
                            class="btn text-white"
                            style="background-color:#C19A6B">
                        Update
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>
