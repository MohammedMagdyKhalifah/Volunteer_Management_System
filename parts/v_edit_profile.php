<?php

?>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit profile</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form -->
                <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                    <!-- name -->
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" placeholder="Enter name"
                            value="<?php echo htmlspecialchars($user->name) ?>">
                    </div>
                    <!-- email -->
                    <div class="form-group">
                        <label for="name">Email</label>
                        <input type="text" class="form-control" placeholder="Enter email"
                            value="<?php echo htmlspecialchars($user->email) ?>">
                    </div>
                    <!-- phone -->
                    <div class="form-group">
                        <label for="name">Phone</label>
                        <input type="text" class="form-control" placeholder="Enter phone"
                            value="<?php echo htmlspecialchars($user->phone) ?>">
                    </div>
                    <!-- address -->
                    <div class="form-group">
                        <label for="name">Address</label>
                        <input type="text" class="form-control" placeholder="Enter address"
                            value="<?php echo htmlspecialchars($user->address) ?>">
                    </div>
                    <!-- skills -->
                    <div class="form-group">
                        <label for="name">Skills</label>
                        <input type="text" class="form-control" placeholder="Enter skills"
                            value="<?php echo htmlspecialchars($user->skills) ?>">
                    </div>
                    <!-- Availability -->
                    <div class="form-group">
                        <label for="name">Availability</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="Radio_Available" <?php echo ($user->available > 0) ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="flexRadioDefault1">
                                Available
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="Radio_Not_available" <?php echo ($user->available <= 0) ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="flexRadioDefault2">
                                Not available
                            </label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>