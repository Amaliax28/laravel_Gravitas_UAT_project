<x-layout>
    <x-content>
        <div>
            <div class="back-btn-container">
                <x-back-btn href="/user-list" />
            </div>
            <!--HEADER-->
            <x-pageTitle>
                User Info
            </x-pageTitle>
        </div>
        <!--TABLE-->
        <section class="registerUser">
            <form method="POST" action="/user/{{ $user->id }}/update" id="regular-form" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="register-wrapper">
                    <div class="reg-label">Profile Picture</div>
                    <div class="reg-field">
                        <label for="userImage">
                            <input class="form-control d-none enable-on-edit" id="userImage" type="file"
                                accept="image/*" name="userImage" onchange="preview()" disabled>
                            <div
                                class="img-box  overflow-hidden position-relative d-flex align-items-center justify-content-center">
                                <img src="{{ $user->userImage ? asset('storage/' . $user->userImage) : asset('images/user.png') }}"
                                    alt="" id="frame">
                                <i id="add-logo" class="position-absolute d-none image-edit">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 5V19" stroke="#383839" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M5 12H19" stroke="#383839" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </i>
                                <div
                                    class="overlay d-flex align-items-center justify-content-center position-absolute top-0 start-0 w-100 h-100 d-none image-edit">
                                    <i>
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 5V19" stroke="#FBFBFA" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M5 12H19" stroke="#FBFBFA" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </i>
                                </div>
                            </div>
                        </label>
                    </div>
                    <div class="reg-label">Username</div>
                    <div class="reg-field">
                        <input type="text" id="username" name="username"
                            class="form-control field-padding form-field border-grey-10 enable-on-edit"
                            value="{{ $user->username }}" disabled>
                        <div class="error-cont">
                            @error('username')
                                <x-formError :message="$message" />
                            @enderror
                        </div>
                    </div>
                    <div class="reg-label">Email</div>
                    <div class="reg-field">
                        <input type="email" id="email" name="email"
                            class="form-control field-padding form-field border-grey-10 enable-on-edit"
                            value="{{ $user->email }}" disabled>
                        <div class="error-cont">
                            @error('email')
                                <x-formError :message="$message" />
                            @enderror
                        </div>
                    </div>
                    <div class="reg-label">Password</div>
                    <div class="reg-field gen-password">
                        <input type="password" autocomplete="new-password" id="password" name="password"
                            class="form-control field-padding form-field border-grey-10 enable-on-edit" disabled>
                        <button type="button" class="btn blue enable-on-edit" onclick="generatePassword()"
                            id="generatePassBtn" disabled>Generate Password</button>
                        @error('password')
                            <x-formError :message="$message" />
                        @enderror
                    </div>
                    <div class="reg-label">Roles</div>
                    <div class="reg-field">
                        <select id="roles" name="roles"
                            class="outline-0  border-grey-10 field-padding enable-on-edit" disabled>
                            <option value="admin" {{ $user->roles == 'admin' ? 'selected' : '' }}>Admin
                            </option>
                            <option value="strategist" {{ $user->roles == 'strategist' ? 'selected' : '' }}>
                                Strategist
                            </option>
                            <option value="developer" {{ $user->roles == 'developer' ? 'selected' : '' }}>Developer
                            </option>
                            <option value="tester" {{ $user->roles == 'tester' ? 'selected' : '' }}>Tester</option>
                        </select>

                    </div>
                </div>
                <div class="col-12 btn-cont">
                    <button type="button" id="editUserBtn" class="btn blue">Edit User</button>
                    <button id="updateUserBtn" class="btn blue imageEdit d-none " onclick="copyToClipboard()">Save
                        changes</button>
                </div>
            </form>
        </section>
        <!--FOOTER-->
        <x-pageFooter />
    </x-content>
    <script src="{{ asset('js/form-handling.js') }}"></script>
    <script>
        // SHOW EDIT USER FORM
        const editUserBtn = document.getElementById("editUserBtn");
        editUserBtn.addEventListener('click', function() {
            const fieldsToEnable = document.querySelectorAll('.enable-on-edit');
            const imageEdit = document.querySelectorAll('.image-edit');
            const updateUserBtn = document.getElementById('updateUserBtn')

            fieldsToEnable.forEach((field) => {
                field.disabled = false;
            });
            imageEdit.forEach((image) => {
                image.classList.remove('d-none');
            })

            updateUserBtn.classList.remove('d-none');
            editUserBtn.classList.add('d-none');
        });
    </script>
</x-layout>
