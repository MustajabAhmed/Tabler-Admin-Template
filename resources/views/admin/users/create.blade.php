<div class="offcanvas offcanvas-end" tabindex="-1" id="create" aria-labelledby="offcanvasEndLabel">
    <div class="offcanvas-header">
        <h2 class="offcanvas-title" id="offcanvasEndLabel">Create Role</h2>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">

        <form  id="createForm" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 col-xl-12">

                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" data-attr="name" name="name"
                            placeholder="Please enter your name">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="text" class="form-control" data-attr="email" name="email"
                            placeholder="Please enter your email">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="text" class="form-control" data-attr="" name="password"
                            placeholder="Please enter your email">
                    </div>

                

                            @if (!empty($data['roles']))
                            <x-admin.select 
                                label="Role" 
                                name="role" 
                                :options="$data['roles']" 
                                optionIdKey="id"
                                optionLabelKey="name" 
                            />
                        @endif
                        

                    <div class="mb-3">
                        <button class="btn btn-primary" type="button" id="submitForm">
                            create
                        </button>
                    </div>
                </div>
            </div>

        </form>














        <div class="mt-3">
            <button class="btn btn-primary" type="button" data-bs-dismiss="offcanvas">
                Close offcanvas
            </button>
        </div>
    </div>
</div>