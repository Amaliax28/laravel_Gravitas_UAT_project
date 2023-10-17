<x-layout>
    <x-content>
        <div>
            <!--HEADER-->
            <x-pageTitle>
                Create User
            </x-pageTitle>
        </div>
        <!--TABLE-->
        <section class="registerUser">
            <form method="POST" action="/users" id="regular-form" enctype="multipart/form-data" autocomplete="off">
                @csrf
                <div class="register-wrapper">
                    <div class="reg-label">Upload Image</div>
                    <div class="reg-field">
                        <label for="userImage">
                            <input class="form-control d-none" id="userImage" type="file" accept="image/*"
                                name="userImage" onchange="preview()">
                            <div
                                class="img-box p-0  overflow-hidden position-relative d-flex align-items-center justify-content-center">
                                <img src="{{ old('userImage') }}" alt="" class=" d-none " id="frame">
                                <i id="add-logo">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 5V19" stroke="#383839" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path d="M5 12H19" stroke="#383839" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                    </svg>
                                </i>
                                <div
                                    class="overlay d-flex align-items-center justify-content-center position-absolute top-0 start-0 w-100 h-100">
                                    <i>
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 5V19" stroke="#FBFBFA" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M5 12H19" stroke="#FBFBFA" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </i>
                                </div>
                            </div>
                        </label>
                    </div>
                    <div class="reg-label">Username</div>
                    <div class="reg-field">
                        <input type="text" id="username" name="username"
                            class="form-control field-padding form-field border-grey-10 " value=" "
                            autocomplete="false">
                        <div class="error-cont">
                            @error('username')
                                <x-formError :message="$message" />
                            @enderror
                        </div>
                    </div>
                    <div class="reg-label">Email</div>
                    <div class="reg-field">
                        <input type="email" id="email" name="email"
                            class="form-control field-padding form-field border-grey-10" value="{{ old('email') }}">
                        <div class="error-cont">
                            @error('email')
                                <x-formError :message="$message" />
                            @enderror
                        </div>
                    </div>
                    <div class="reg-label">Password</div>
                    <div class="reg-field gen-password">
                        <input type="password" autocomplete="new-password" id="password" name="password"
                            class="form-control field-padding form-field border-grey-10" value="">
                        <button type="button" class="btn blue" onclick="generatePassword()">Generate Password</button>
                        @error('password')
                            <x-formError :message="$message" />
                        @enderror
                    </div>
                    <div class="reg-label">Roles</div>
                    <div class="reg-field">
                        <select id="roles" name="roles" class="outline-0  border-grey-10 field-padding">
                            <option value="admin">Admin</option>
                            <option value="strategist">Strategist</option>
                            <option value="developer">Developer</option>
                            <option value="tester">Tester</option>
                        </select>
                    </div>
                </div>
                <div class="col-12 btn-cont">
                    <button type="submit" id="createUserBtn" class="btn blue" onclick="copyToClipboard()">Create
                        user</button>
                </div>
            </form>
        </section>
        <!--FOOTER-->
        <x-pageFooter />
    </x-content>
    <script src="{{ asset('js/form-handling.js') }}"></script>
</x-layout>
