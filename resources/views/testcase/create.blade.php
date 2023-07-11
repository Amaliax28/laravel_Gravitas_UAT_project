<x-modal-layout id="new-testcase-modal" class="modal-form">
    <x-modal-header>Create new test case</x-modal-header>
    <x-modal-content>
        <x-modal-form action="/project/{{$project->id}}/session/{{$session->id}}/testcases" id="modal-form" class="tc-modal">
            <div class="form-container ">
                <div class="row m-0">
                    <div class="col-auto label-container">
                        <label for="projectImg">Upload Image</label>
                    </div>
                    <div class="col">
                        <label for="projectImage">
                            <input class="form-control d-none" id="projectImage" type="file" accept="image/*" name="testCaseImage" onchange="preview()">
                            <div class="img-box testcase  overflow-hidden position-relative d-flex align-items-center justify-content-center">
                                <img src="#" alt="" class=" d-none " id="frame">
                                <i id="add-logo">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 5V19" stroke="#383839" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M5 12H19" stroke="#383839" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </i>
                                <div class="overlay d-flex align-items-center justify-content-center position-absolute top-0 start-0 w-100 h-100 ">
                                    <i>
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 5V19" stroke="#FBFBFA" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M5 12H19" stroke="#FBFBFA" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </i>
                                </div>
                            </div>
                        </label>
                        @error('testCaseImage')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                <div class="row m-0 form-row">
                    <div class="col-auto label-container">
                        <label for="testCaseText">Comment</label>
                    </div>
                    <div class="col">
                        <textarea name="testCaseText" id="testCaseText" maxlength="200" class="modal-input-border comment"></textarea>
                    </div>
                </div>
                <div class="row m-0 form-row">
                    <div class="col-auto label-container">
                        <label for="testCaseText">Time</label>
                    </div>
                    <div class="col">
                        <input type="time" name="testCaseTime" id="testCaseTime" required>
                    </div>
                </div>
            </div>
            <div class="btn-container">
                <button class="btn white" type="button" data-bs-dismiss="modal">Cancel</button>
                <button class="btn blue" id="submitBtn" >Create Test Case</button>
            </div>
        </x-modal-form>
    </x-modal-content>
</x-modal-layout>
