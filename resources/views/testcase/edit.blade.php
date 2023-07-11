@props(['testcase'])
<x-modal-layout id="modal-edit-testcase-{{$testcase->id}}" class="modal-form">
    <x-modal-header>Edit test case details</x-modal-header>
    <x-modal-content>
        <x-modal-form action="/project/{{$project->id}}/session/{{$session->id}}/testcase/{{$testcase->id}}" id="modal-form"
            class="tc-modal">
            @method('PUT')
            <div class="form-container ">
                <div class="row m-0">
                    <div class="col-auto label-container">
                        <label for="testCaseImage">Upload Image</label>
                    </div>
                    <div class="col">
                        <label for="projectImage">
                            <input class="form-control d-none" id="testCaseImage{{$testcase->id}}" type="file" accept="image/*"
                                name="testCaseImage" onchange="preview1(event, '{{$testcase->id}}')">
                            <div
                                class="img-box testcase  overflow-hidden position-relative d-flex align-items-center justify-content-center">
                                <img src="{{$testcase->testCaseImage ? asset('storage/'.$testcase->testCaseImage) : asset('images/no-photo.png') }}" id="frame{{$testcase->id}}" alt="Test Case Image" class="w-100 h-100 object-fit-contain" id="frame">
                                <i class="d-none" id="add-logo{{$testcase->id}}">
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
                        @error('testCaseImage')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="row m-0 form-row">
                    <div class="col-auto label-container">
                        <label for="testCaseText">Comment</label>
                    </div>
                    <div class="col">
                        <textarea name="testCaseText"  id="testCaseText{{$testcase->id}}" class="modal-input-border comment">{{$testcase['testCaseText']}}</textarea>
                    </div>
                </div>
                <div class="row m-0 form-row">
                    <div class="col-auto label-container">
                        <label for="testCaseText">Time</label>
                    </div>
                    <div class="col">
                        <input type="time" name="testCaseTime" id="testCaseTime" value={{$testcase->testCaseTime}} required>
                    </div>
                </div>

            </div>
            <div class="btn-container">
                <button class="btn white " type="button" data-bs-dismiss="modal">Cancel</button>
                <button class="btn blue" id="submitBtn">Update Test Case</button>
            </div>
        </x-modal-form>
    </x-modal-content>
    <script>
        // For Image Preview when Image is Uploaded
        function preview1(event,testcaseId) {
            var addLogo = document.getElementById('add-logo' + testcaseId);
            var frame = document.getElementById('frame' + testcaseId);
            frame.classList.remove("d-none");//display image
            addLogo.classList.add("d-none"); // remove the add icon
            frame.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
</x-modal-layout>
