<x-layout>
    <x-content>
        <div>
            <!--HEADER-->
            <x-pageTitle>
                Create User
            </x-pageTitle>
        </div>
        <!--TABLE-->
        <div class="content">
            <div class="content user-form ">
                <form method="POST" action="/users" class="w-auto " id="regular-form" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group upload-img ">
                        <label for="userImage" class="form-label  my-auto">Upload Image</label>
                        <label for="userImage">
                            <input class="form-control d-none" id="userImage" type="file" accept="image/*" name="userImage"
                                onchange="preview()">
                            <div
                                class="img-box p-0  overflow-hidden position-relative d-flex align-items-center justify-content-center">
                                <img src="{{ old('userImage')}}" alt="" class=" d-none " id="frame">
                                <i id="add-logo">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 5V19" stroke="#383839" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M5 12H19" stroke="#383839" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </i>
                                <div
                                    class="overlay d-flex align-items-center justify-content-center position-absolute top-0 start-0 w-100 h-100 ">
                                    <i>
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 5V19" stroke="#FBFBFA" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path d="M5 12H19" stroke="#FBFBFA" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                    </i>
                                </div>
                            </div>
                        </label>
                    </div>
                    <div class="w-100  ps-1 text-start">
                        @error('userImage')
                            <p class="text-danger m-0 p-0 fs-sm ms-md-0 ms-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="username" class="form-label my-auto ">Username</label>
                        <input type="text" id="username" name="username" class="form-control h-100"
                            value="{{ old('username') }}">
                    </div>
                    <div class="w-100  ps-1 text-start">
                        @error('username')
                            <p class="text-danger m-0 p-0 fs-sm ms-md-0 ms-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email" class="form-label my-auto ">Email</label>
                        <input type="email" id="email" name="email" class="form-control h-100"
                            value="{{ old('email') }}">
                    </div>
                    <div class="w-100  ps-1 text-start">
                        @error('email')
                            <p class="text-danger m-0 p-0 fs-sm ms-md-0 ms-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password" class="form-label my-auto ">Generate Password</label>
                        <div class="input-group m-0 p-0 ">
                            <input type="text" id="password" name="password" class="form-control border-0 w-75 h-100">
                            <button class="border-0 toggle-password m-0 text-wrap text-center" type="button" onclick="generatePassword()">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#9CA3AF"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M12.0789 2.25C7.2854 2.25 3.34478 5.913 2.96055 10.5833H2.00002C1.69614 10.5833 1.42229 10.7667 1.30655 11.0477C1.19081 11.3287 1.25606 11.6517 1.47178 11.8657L3.15159 13.5324C3.444 13.8225 3.91567 13.8225 4.20808 13.5324L5.88789 11.8657C6.10361 11.6517 6.16886 11.3287 6.05312 11.0477C5.93738 10.7667 5.66353 10.5833 5.35965 10.5833H4.4668C4.84652 6.75167 8.10479 3.75 12.0789 3.75C14.8484 3.75 17.2727 5.20845 18.6156 7.39279C18.8325 7.74565 19.2944 7.85585 19.6473 7.63892C20.0002 7.42199 20.1104 6.96007 19.8934 6.60721C18.2871 3.99427 15.3873 2.25 12.0789 2.25Z" fill="#9CA3AF"></path> <path opacity="0.5" d="M20.8412 10.4666C20.5491 10.1778 20.0789 10.1778 19.7868 10.4666L18.1005 12.1333C17.8842 12.3471 17.8185 12.6703 17.934 12.9517C18.0496 13.233 18.3236 13.4167 18.6278 13.4167H19.5269C19.1456 17.2462 15.876 20.25 11.8828 20.25C9.10034 20.25 6.66595 18.7903 5.31804 16.6061C5.10051 16.2536 4.63841 16.1442 4.28591 16.3618C3.93342 16.5793 3.82401 17.0414 4.04154 17.3939C5.65416 20.007 8.56414 21.75 11.8828 21.75C16.6907 21.75 20.6476 18.0892 21.0332 13.4167H22.0002C22.3044 13.4167 22.5784 13.233 22.694 12.9517C22.8096 12.6703 22.7438 12.3471 22.5275 12.1333L20.8412 10.4666Z" fill="#9CA3AF"></path> </g></svg>                            </button>

                            </button>
                        </div>
                    </div>
                    <div class="w-100  ps-1 text-start">
                        @error('password')
                            <p class="text-danger m-0 p-0 fs-sm ms-md-0 ms-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="roles" class="form-label my-auto ">Roles</label>
                        <select id="roles" name="roles" class="outline-0 h-100">
                            <option value="admin">Admin</option>
                            <option value="strategist">Strategist</option>
                            <option value="developer">Developer</option>
                            <option value="tester">Tester</option>
                        </select>
                    </div>
                    <div class="btn-container">
                        <button type="submit" id="createUserBtn" class="btn blue" >Create user</button>
                    </div>
                </form>
            </div>
        </div>
        <!--FOOTER-->
        <x-pageFooter/>
    </x-content>
    <script>
        //DISABLE BUTTON UNTILL ALL FIELDS ARE FILLED
        const form = document.getElementById('regular-form');
        const inputs = form.querySelectorAll('input:not(#userImage), select:not(#roles)');
        const createUserBtn = document.getElementById('createUserBtn');

        // Function to check if all inputs are filled
        function checkInputs() {
        let allInputsFilled = true;
        inputs.forEach(input => {
            if (input.value.trim() === '') {
            allInputsFilled = false;
            return;
            }
        });

        // Enable or disable the button based on input status
        createUserBtn.disabled = !allInputsFilled;
        }

        // Add event listener to each input element
        inputs.forEach(input => {
        input.addEventListener('change', checkInputs);
        });



        //  GENERATE PASSWORD
        function generatePassword() {
            var length = 10; // length of the generated password
            var charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"; // characters to include in the password
            var password = "";

            for (var i = 0; i < length; i++) {
                var randomIndex = Math.floor(Math.random() * charset.length);
                password += charset.charAt(randomIndex);
            }

            document.getElementById("password").value = password;
        }
    </script>
</x-layout>
