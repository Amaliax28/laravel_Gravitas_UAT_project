<x-layout>
    <x-content>
        <div>
            <!--HEADER-->
            <x-pageTitle>
                Account Settings
            </x-pageTitle>
        </div>
        <!--TABLE-->
        <section class="registerUser">
            <form method="POST" action="/users/{{ auth()->user()->id }}" enctype="multipart/form-data" autocomplete="off">
                @csrf
                @method('PUT')
                <div class="register-wrapper">
                    <div class="reg-label">Upload Image</div>
                    <div class="reg-field">
                        <label for="userImage">
                            <input class="form-control d-none enable-on-edit" id="userImage" type="file"
                                accept="image/*" name="userImage" onchange="preview()">
                            <div
                                class="img-box  overflow-hidden position-relative d-flex align-items-center justify-content-center">
                                <img src="{{ auth()->user()->userImage ? asset('storage/' . auth()->user()->userImage) : asset('images/user.png') }}"
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
                                    class="overlay d-flex align-items-center justify-content-center position-absolute top-0 start-0 w-100 h-100  image-edit">
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
                            class="form-control field-padding form-field border-grey-10 "
                            value="{{ auth()->user()->username }}" autocomplete="false">
                        <div class="error-cont">
                            @error('username')
                                <x-formError :message="$message" />
                            @enderror
                        </div>
                    </div>
                    <div class="reg-label">Email</div>
                    <div class="reg-field">
                        <input type="email" id="email" name="email"
                            class="form-control field-padding form-field border-grey-10"
                            value="{{ auth()->user()->email }}">
                        <div class="error-cont">
                            @error('email')
                                <x-formError :message="$message" />
                            @enderror
                        </div>
                    </div>
                    <div class="reg-label">New Password</div>
                    <div class="reg-field ">
                        <div class="input-group eye-toggle border-grey-10 ">
                            <input type="password" autocomplete="new-password" id="password" name="password"
                                class="form-control field-padding form-field border-grey-10 border-none ."
                                onchange="verifyPassword('confirmPassword','password')">
                            <span class="input-group-text password-toggle border-none"
                                onclick="togglePassword('password')">
                                <img src="{{ asset('images/eye.svg') }}" class="passwordEyeOpen" alt="open eye">
                                <img src="{{ asset('images/slashed-eye.svg') }}" class="passwordEyeSlashed d-none"
                                    alt="slashed eye">
                            </span>
                        </div>
                        @error('password')
                            <x-formError :message="$message" />
                        @enderror
                    </div>
                    <div class="reg-label">Confirm Password</div>
                    <div class="reg-field ">
                        <div class="input-group eye-toggle border-grey-10 ">
                            <input type="password" autocomplete="off" id="confirmPassword" name="password_confirmation"
                                class="form-control field-padding form-field border-grey-10 border-none "
                                onchange="verifyPassword('confirmPassword','password')">
                            <span class="input-group-text password-toggle border-none"
                                onclick="togglePassword('confirmPassword')">
                                <img src="{{ asset('images/eye.svg') }}" class="confirmPasswordEyeOpen" alt="open eye">
                                <img src="{{ asset('images/slashed-eye.svg') }}"
                                    class="confirmPasswordEyeSlashed d-none" alt="slashed eye">
                            </span>
                        </div>
                        @error('password_confirmation')
                            <x-formError class="d-none" id="passError"
                                message="{{ isset($message) ? $message : 'Password Doesnt Match' }}" />
                        @enderror
                        <x-formError class="d-none" id="passError"
                            message="{{ isset($message) ? $message : 'The password field confirmation does not match.' }}" />

                    </div>
                    <div class="reg-label">Roles</div>
                    <div class="reg-field">
                        <select id="roles" name="roles" class="outline-0  border-grey-10 field-padding">
                            <option value="admin" {{ auth()->user()->roles == 'admin' ? 'selected' : '' }}>Admin
                            </option>
                            <option value="strategist" {{ auth()->user()->roles == 'strategist' ? 'selected' : '' }}>
                                Strategist</option>
                            <option value="developer" {{ auth()->user()->roles == 'developer' ? 'selected' : '' }}>
                                Developer</option>
                            <option value="tester" {{ auth()->user()->roles == 'tester' ? 'selected' : '' }}>Tester
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-12 btn-cont">
                    <button type="submit" id="saveChangesBtn" class="btn blue" onclick="copyToClipboard()">Save
                        changes</button>
                </div>
            </form>
        </section>
        <!--FOOTER-->
        <x-pageFooter />
    </x-content>
    <script src="{{ asset('js/form-handling.js') }}"></script>
</x-layout>
