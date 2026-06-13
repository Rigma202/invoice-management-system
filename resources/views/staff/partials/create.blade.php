<div class="modal fade"
     id="createStaffModal"
     tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <h5>Create Staff</h5>

                <button class="btn-close"
                        data-bs-dismiss="modal"></button>

            </div>

            <div class="modal-body">

                <form id="staffCreateForm">

                    @csrf

                    <div class="mb-3">

                        <label>Name</label>

                        <input type="text"
                               name="name"
                               id="name"
                               class="form-control">

                        <small id="name_error"
                               class="text-danger"></small>

                    </div>

                    <div class="mb-3">

                        <label>Email</label>

                        <input type="email"
                               name="email"
                               id="email"
                               class="form-control">

                        <small id="email_error"
                               class="text-danger"></small>

                    </div>

                    <button type="submit"
                            class="btn text-white"
                            style="background-color:#C19A6B">
                        Save
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>
