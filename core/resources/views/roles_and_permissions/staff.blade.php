@extends('app')
<style>
    /* Make buttons take full width on small screens */
    @media (max-width: 768px) {
        .d-grid {
            display: block;
            width: 100%;
        }

        .btn-group {
            display: flex;
            gap: 5px;
            flex-wrap: wrap;
        }
    }
    
    table.table {

        font-size:13px;
    }
    
    .profile-img {
    width: 40px; /* Adjust as needed */
    height: 40px; /* Set height to prevent stretching */
    object-fit: cover; /* Keeps proportions without stretching */
    border-radius: 50%; /* Makes it round (optional) */
}

.password-input-group {
    position: relative;
}
.password-toggle {
    position: absolute;
    right: 12px;
    top: 38px;
    cursor: pointer;
    color: #6c757d;
}
.password-toggle:hover {
    color: #495057;
}
 thead{
    border-color: inherit;
    border-style: none !important;
    border-width: 0;

</style>
<title>{{ $title }} | JPS</title>
@section('content')
<div class="col-md-12 content-header">
    <h5><i class="fa fa-list"></i> {{ $title }}</h5>
</div>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- Filter Section -->
            <div class="card mb-3">
                <div class="card-body">
                     <!--<div class="row g-2 mb-3 d-flex justify-content-end">-->
                     <!--   <button class="btn btn-primary"><i class="fa fa-plus"></i> @lang('app.add_staff')</button>-->
                     <!--</div> -->
                    <div class="row search-row align-items-center g-2 mb-3">
                        <!-- Button Group -->
                        <!--<div class="col-lg-6 col-md-12 mb-2">-->
                        <!--    <div class="btn-group w-100" role="group">-->
                        <!--        <button class="btn btn-outline-secondary btn-sm">@lang('app.column_visibility')</button>-->
                        <!--        <button class="btn btn-outline-secondary btn-sm">@lang('app.copy')</button>-->
                        <!--        <button class="btn btn-outline-secondary btn-sm">@lang('app.csv')</button>-->
                        <!--        <button class="btn btn-outline-secondary btn-sm">@lang('app.excel')</button>-->
                        <!--        <button class="btn btn-outline-secondary btn-sm">@lang('app.pdf')</button>-->
                        <!--        <button class="btn btn-outline-secondary btn-sm">@lang('app.print')</button>-->
                        <!--    </div>-->
                                 
                            
                        <!--</div>-->
                        <div class="col-lg-12 col-md-12 g-2 mb-3 d-flex justify-content-end">
                            @if($canAdminStaffAddStaff)
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStaffModal"><i class="fa fa-plus"></i> @lang('app.add_staff')</button>
                            @endif
                        </div>
                    </div>

                    <!-- Search Section Aligned to Right -->
                    <div class="row">
                        <div class="col-lg-12 d-flex justify-content-end align-items-baseline">
                            <label for="search" class="form-label me-2">{{ trans('app.search') }} : &nbsp;&nbsp;&nbsp;</label>
                            <input type="text" id="search" class="form-control form-control-sm w-auto" placeholder="{{ trans('app.search') }}">
                            <a href="#" class="btn btn-primary btn-sm ms-2" id="search-results">
                                <strong>{{ trans('app.search_b') }}</strong>
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 d-flex justify-content-start align-items-baseline">
                            <label for="show" class="form-label me-2">{{ trans('app.show') }} : &nbsp;&nbsp;&nbsp;</label>
                            <select type="select"  class="form-control form-control-sm w-auto form-select">
                                <option selected>10</option>
                                <option >20</option>
                                <option >50</option>
                                <option >100</option>
                                <option >500</option>
                            </select>&nbsp;&nbsp;    
                                <p><strong>{{ trans('app.entries') }}</strong></p>
                        </div>
                    </div>
                    <!-- Table Section -->
                    <p><strong>{{ trans('app.Showing') }} 1 {{ trans('app.to') }} 5 of {{ trans('app.entries') }}</strong></p>
                    <div class="table-responsive mt-3">
                        <table class="table ">
                            <thead>
                                <tr>
                                    <th><strong># <i class="fa fa-sort"></i></strong></th>
                                    <th><strong>{{ trans('app.image') }} <i class="fa fa-sort"></i></strong></th>
                                    <th><strong>{{ trans('app.staff_name') }} <i class="fa fa-sort"></i></strong></th>
                                    <th><strong>{{ trans('app.email') }} <i class="fa fa-sort"></i></strong></th>
                                    <th><strong>{{ trans('app.role') }} <i class="fa fa-sort"></i></strong></th>
                                    <!--<th><strong>{{ trans('app.department') }} <i class="fa fa-sort"></i></strong></th>-->
                                    <th><strong>{{ trans('app.status') }} <i class="fa fa-sort"></i></strong></th>
                                    <th><strong>{{ trans('app.action') }}</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($staffUsers as $index => $user)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <img src="{{ $user->photo ? asset('uploads/user_photos/' . $user->photo) : asset('assets/images/icon/user-default.png') }}" class="profile-img">
                                        </td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->staffRole->display_name ?? 'N/A' }}</td>
                                        <!--<td>{{ $user->staffRole->department->name ?? '-' }}</td>-->
                                        <td>{{ $user->status == 1 ? 'Active' : 'Inactive' }}</td>
                                        <td>
                                             @if ($canAdminStaffEditStaff)
                                                    <div class="btn-group">
                                                        @php
                                                            // Split username into first and last name
                                                            $nameParts = explode(' ', $user->username, 2);
                                                            $firstName = $nameParts[0] ?? '';
                                                            $lastName = $nameParts[1] ?? '';
                                                        @endphp
                                                        <a href="#" class="btn btn-warning btn-sm editStaffBtn"
                                                            data-bs-toggle="modal" data-bs-target="#updateStaffModal"
                                                            data-id="{{ $user->uuid }}"
                                                            data-first_name="{{ $firstName }}"
                                                            data-last_name="{{ $lastName }}"
                                                            data-email="{{ $user->email }}"
                                                            data-role="{{ $user->role_id }}"
                                                            data-status="{{ $user->status == 1 ? 'active' : 'inactive' }}">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                    </div>
                                                @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div> <!-- End Table Responsive -->
                </div>
                

<!-- Add Staff Modal -->
<div class="modal fade" id="addStaffModal" tabindex="-1" aria-labelledby="addStaffModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg mt-5"> <!-- Increased size for better alignment -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addStaffModalLabel">@lang('app.add_staff')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addStaffForm">
                    @csrf
                    <div class="row">
                        <!-- First Name -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label"><strong>{{ trans('app.first_name') }}</strong></label>
                            <input type="text" name="first_name" class="form-control" placeholder="{{ trans('app.enter_first_name') }}">
                        </div>

                        <!-- Last Name -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label"><strong>{{ trans('app.last_name') }}</strong></label>
                            <input type="text" name="last_name" class="form-control" placeholder="{{ trans('app.enter_last_name') }}">
                        </div>
                    </div>

                    <div class="row">
                        <!-- Email -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label"><strong>{{ trans('app.email') }} <span class="text-danger">*</span></strong></label>
                            <input type="email" name="email" class="form-control" placeholder="{{ trans('app.email_valid') }}">
                        </div>

                        <!-- Role -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label"><strong>{{ trans('app.role') }}<span class="text-danger">*</span></strong></label>
                            <select name="role_id" class="form-select">
                                <option selected disabled>{{ trans('app.please_select') }}</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->uuid }}">{{ $role->display_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Password -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label"><strong>{{ trans('app.password') }} <span class="text-danger">*</span></strong></label>
                            <input type="password" name="password" class="form-control" placeholder="{{ trans('app.enter_password') }}">
                        </div>

                        <!-- Confirm Password -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label"><strong>{{ trans('app.confirm_password') }} <span class="text-danger">*</span></strong></label>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="{{ trans('app.confirm_password') }}">
                        </div>

                        <!-- Status -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label"><strong>{{ trans('app.status') }} <span class="text-danger">*</span></strong></label>
                            <select name="status" class="form-select">
                                <option value="active">@lang('app.active')</option>
                                <option value="inactive">@lang('app.inactive')</option>
                            </select>                            
                        </div>
                    </div>
                </form>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{ trans('app.cancel') }}</button>
                <button type="submit" class="btn btn-dark" id="createBtn">{{ trans('app.create') }}</button>
            </div>
        </div>
    </div>
</div>

<!-- Update Staff Modal -->
<div class="modal fade" id="updateStaffModal" tabindex="-1" aria-labelledby="updateStaffModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg mt-5">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateStaffModalLabel">{{ trans('app.update_staff') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateRoleForm" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="staff_id" name="staff_id"> 
                    <div class="row">
                        <!-- First Name -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label"><strong>{{ trans('app.first_name') }}</strong></label>
                            <input type="text" class="form-control" name="first_name" placeholder="{{ trans('app.enter_first_name') }}">
                        </div>

                        <!-- Last Name -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label"><strong>{{ trans('app.last_name') }}</strong></label>
                            <input type="text" class="form-control" name="last_name" placeholder="{{ trans('app.enter_last_name') }}">
                        </div>
                    </div>

                    <div class="row">
                        <!-- Email -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label"><strong>{{ trans('app.email') }} <span class="text-danger">*</span></strong></label>
                            <input type="email" class="form-control" name="email" placeholder="{{ trans('app.email_valid') }}">
                        </div>

                        <!-- Role Dropdown -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label"><strong>{{ trans('app.role') }} <span class="text-danger">*</span></strong></label>
                            <select class="form-select" name="role_id">
                                <option selected disabled>{{ trans('app.please_select') }}</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->uuid }}">{{ $role->display_name }}</option>
                                @endforeach
                            </select>
                        </div>
                         <div class="col-md-6 mb-3">
                        <label class="form-label"><strong>{{ trans('app.password') }}</strong></label>
                        <div class="password-input-group">
                            <input type="password" name="password" class="form-control" placeholder="{{ trans('app.enter_password') }}" id="updatePassword">
                            <span class="password-toggle" onclick="togglePassword('updatePassword', 'updatePasswordIcon')">
                                <!--<i class="fas fa-eye" id="updatePasswordIcon"></i>-->
                            </span>
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label"><strong>{{ trans('app.confirm_password') }}</strong></label>
                        <div class="password-input-group">
                            <input type="password" name="password_confirmation" class="form-control" placeholder="{{ trans('app.confirm_password') }}" id="updatePasswordConfirmation">
                            <span class="password-toggle" onclick="togglePassword('updatePasswordConfirmation', 'updatePasswordConfirmationIcon')">
                                <!--<i class="fas fa-eye" id="updatePasswordConfirmationIcon"></i>-->
                            </span>
                        </div>
                    </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label"><strong>{{ trans('app.status') }} <span class="text-danger">*</span></strong></label>
                            <select id="updateStatus" class="form-select" name="status">
                                <option value="active">@lang('app.active')</option>
                                <option value="inactive">@lang('app.inactive')</option>
                            </select>
                        </div>
                    </div>

                    <!--<div class="row">-->
                    <!--     Password -->
                    <!--    <div class="col-md-6 mb-3">-->
                    <!--        <label class="form-label"><strong>{{ trans('app.password') }}</strong></label>-->
                    <!--         Password -->
                    <!--        <input type="password" name="password" class="form-control" placeholder="{{ trans('app.enter_password') }}">-->
                    <!--    </div>-->

                    <!--     Confirm Password -->
                    <!--    <div class="col-md-6 mb-3">-->
                    <!--        <label class="form-label"><strong>{{ trans('app.confirm_password') }}</strong></label>-->
                    <!--         Confirm Password -->
                    <!--        <input type="password" name="password_confirmation" class="form-control" placeholder="{{ trans('app.confirm_password') }}">-->
                    <!--    </div>-->

                        
                    <!--</div>-->
                   
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{ trans('app.cancel') }}</button>
                <button type="button" class="btn btn-dark" id="editBtn">{{ trans('app.update') }}</button>
            </div>
        </div>
    </div>
</div>


<!-- Bootstrap CSS & JS (if not already included) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Include SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- JavaScript -->
<script>
    var updateStaffRoute = "{{ route('staff.update', ['uuid' => '__UUID__']) }}";
</script>

<script>
document.getElementById('createBtn').addEventListener('click', function (event) {
    event.preventDefault(); // Prevent actual form submission

    Swal.fire({
        title: "@lang('app.are_you_sure_staff')",
        text: "@lang('app.you_are_about_to_create')",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "@lang('app.yes')",
        cancelButtonText: "@lang('app.cancel')"
    }).then((result) => {
        if (result.isConfirmed) {
            // Collect form data
            let formData = new FormData(document.getElementById('addStaffForm'));

            // Send AJAX request to store staff
            fetch("{{ route('storeStaff') }}", {
                method: "POST",
                body: formData,
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        title: "@lang('app.success')!",
                        text: "@lang('app.staff_added_successfully')",
                        icon: "success",
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "@lang('app.ok')"
                    }).then(() => {
                        location.reload(); // Reload page after success
                    });
                } else {
                    Swal.fire({
                        title: "@lang('app.error')!",
                        text: "@lang('app.staff_creation_failed')",
                        icon: "error",
                        confirmButtonColor: "#d33",
                        confirmButtonText: "@lang('app.ok')"
                    });
                }
            })
            .catch(error => {
                console.error("Error:", error);
                Swal.fire({
                    title: "@lang('app.error')!",
                    text: "@lang('app.something_went_wrong')",
                    icon: "error",
                    confirmButtonColor: "#d33",
                    confirmButtonText: "@lang('app.ok')"
                });
            });
        }
    });
});

document.addEventListener('DOMContentLoaded', function() {
                            document.querySelectorAll('.editStaffBtn').forEach(button => {
                                button.addEventListener('click', function() {
                                    const staffId = button.getAttribute('data-id');
                                    const firstName = button.getAttribute('data-first_name') || '';
                                    const lastName = button.getAttribute('data-last_name') || '';
                                    const email = button.getAttribute('data-email');
                                    const role = button.getAttribute('data-role');
                                    let status = button.getAttribute('data-status');

                                    console.log("Debug - Retrieved data:", {
                                        staffId,
                                        firstName,
                                        lastName,
                                        email,
                                        role,
                                        originalStatus: status
                                    });

                                    // Convert status if stored as 1/0
                                    status = (status == 1 || status == '1' || status.toLowerCase() === "active") ?
                                        "active" : "inactive";

                                    console.log("Debug - Converted status:", status);

                                    // Populate modal fields
                                    document.getElementById('staff_id').value = staffId;

                                    // Set first name
                                    const firstNameInput = document.querySelector(
                                        '#updateStaffModal input[name="first_name"]');
                                    if (firstNameInput) {
                                        firstNameInput.value = firstName;
                                        console.log("Set first name:", firstName);
                                    }

                                    // Set last name
                                    const lastNameInput = document.querySelector(
                                        '#updateStaffModal input[name="last_name"]');
                                    if (lastNameInput) {
                                        lastNameInput.value = lastName;
                                        console.log("Set last name:", lastName);
                                    }

                                    // Set email
                                    const emailInput = document.querySelector(
                                        '#updateStaffModal input[name="email"]');
                                    if (emailInput) {
                                        emailInput.value = email;
                                    }

                                    // Set role dropdown
                                    const roleSelect = document.querySelector(
                                        '#updateStaffModal select[name="role_id"]');
                                    if (roleSelect) {
                                        roleSelect.value = role;
                                        console.log("Set role:", role);
                                    }

                                    // Set status dropdown
                                    const statusSelect = document.querySelector(
                                        '#updateStaffModal select[name="status"]');
                                    if (statusSelect) {
                                        statusSelect.value = status;
                                        console.log("Final selected status in modal:", statusSelect.value);
                                    }

                                    // Clear password fields
                                    const passwordInput = document.querySelector(
                                        '#updateStaffModal input[name="password"]');
                                    const confirmPasswordInput = document.querySelector(
                                        '#updateStaffModal input[name="password_confirmation"]');
                                    if (passwordInput) passwordInput.value = '';
                                    if (confirmPasswordInput) confirmPasswordInput.value = '';
                                });
                            });

                            // Update button click handler
                            document.getElementById('editBtn').addEventListener('click', function(event) {
                                event.preventDefault();

                                let staffId = document.getElementById("staff_id").value;
                                if (!staffId) {
                                    Swal.fire({
                                        title: "@lang('app.error')!",
                                        text: "UUID is missing. Please try again.",
                                        icon: "error"
                                    });
                                    return;
                                }

                                let formData = new FormData(document.getElementById('updateRoleForm'));
                                formData.append("_method", "PUT");

                                // Debug: Log form data
                                console.log("Form data being sent:");
                                for (let [key, value] of formData.entries()) {
                                    console.log(key, value);
                                }

                                Swal.fire({
                                    title: "@lang('app.are_you_sure_staff')",
                                    text: "@lang('app.you_are_about_to_update')",
                                    icon: "warning",
                                    showCancelButton: true,
                                    confirmButtonColor: "#3085d6",
                                    cancelButtonColor: "#d33",
                                    confirmButtonText: "@lang('app.yes')",
                                    cancelButtonText: "@lang('app.cancel')"
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        let updateUrl = updateStaffRoute.replace('__UUID__', staffId);
                                        console.log("Sending request to:", updateUrl);

                                        fetch(updateUrl, {
                                                method: "POST",
                                                body: formData,
                                                headers: {
                                                    "X-CSRF-TOKEN": document.querySelector(
                                                        'meta[name="csrf-token"]').content,
                                                    "Accept": "application/json"
                                                }
                                            })
                                            .then(response => {
                                                console.log("Response status:", response.status);
                                                return response.json();
                                            })
                                            .then(data => {
                                                console.log("Response data:", data);
                                                if (data.success) {
                                                    Swal.fire({
                                                        title: "@lang('app.success')!",
                                                        text: "@lang('app.staff_updated_successfully')",
                                                        icon: "success"
                                                    }).then(() => location.reload());
                                                } else {
                                                    Swal.fire({
                                                        title: "@lang('app.error')!",
                                                        text: data.message || "@lang('app.staff_update_failed')",
                                                        icon: "error"
                                                    });
                                                }
                                            })
                                            .catch(error => {
                                                console.error("Error:", error);
                                                Swal.fire({
                                                    title: "@lang('app.error')!",
                                                    text: "@lang('app.something_went_wrong')",
                                                    icon: "error"
                                                });
                                            });
                                    }
                                });
                            });
                        });




</script>


@endsection
