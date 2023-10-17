<x-modal-layout id="new-project-modal" class="modal-form ">
    <x-modal-header>Create new project</x-modal-header>
    <x-modal-content>
        <x-modal-form action="/projects" id="modal-form">
            <div class="form-container">
                <div class="row m-0">
                    <div class="col-auto label-container">
                        <label for="projectImg">Project Image</label>
                    </div>
                    <div class="col  project-image-col">
                        <label for="projectImage">
                            <input class="form-control d-none" id="projectImage" type="file" accept="image/*"
                                name="projectImg" onchange="preview()">
                            <div
                                class="img-box overflow-hidden position-relative d-flex align-items-center justify-content-center">
                                <img src="#" alt="" class=" d-none " id="frame">
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
                </div>
                <div class="row">
                    <div class="col">
                        @error('projectImg')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="row m-0 form-row ">
                    <div class="col-auto label-container">
                        <label for="projectName">Project Name</label>
                    </div>
                    <div class="col">
                        <input type="text" name="projectName" id="projectName" class="modal-input-border"
                            maxlength="30">
                    </div>
                </div>
                <div class="row m-0 form-row">
                    <div class="col-auto label-container">
                        <label for="projectName">Details</label>
                    </div>
                    <div class="col">
                        <textarea name="projectDetails" id="projectDetails" maxlength="200" class="modal-input-border"></textarea>
                    </div>
                </div>
                <div class="row m-0 form-row">
                    <div class="col-auto label-container">
                        <label for="status">Status</label>
                    </div>
                    <div class="col">
                        <select name="status" id="status">
                            <option value="INCOMPLETE">Incomplete</option>
                            <option value="ONGOING">Ongoing</option>
                            <option value="COMPLETE">Complete</option>
                        </select>
                    </div>
                </div>
                <!--Give Autofill sugesstions from database here-->
                <div class="row m-0 form-row ">
                    <div class="col-auto label-container">
                        <label for="testerName">Tester's Name</label>
                    </div>
                    <div class="col">
                        <input type="text" name="tester" id="tester" class="modal-input-border">
                    </div>
                </div>
            </div>
            <x-button-modal>
                Create Project
            </x-button-modal>
        </x-modal-form>
    </x-modal-content>
</x-modal-layout>
<script src="{{ asset('js/modal-form-handling.js') }}"></script>
