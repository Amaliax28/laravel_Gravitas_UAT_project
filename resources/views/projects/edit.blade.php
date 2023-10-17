@props(['project'])
@props(['testers'])
<x-modal-layout id="edit-project-modal-{{ $project->id }}" class="modal-form">
    <x-modal-header>Edit project details</x-modal-header>
    <x-modal-content>
        <x-modal-form action="/projects/{{ $project->id }}">
            @method('PUT')
            <div class="form-container">
                <div class="row m-0">
                    <div class="col-auto label-container">
                        <label for="projectImg">Project Image</label>
                    </div>
                    <div class="col">
                        <label for="projectImage">
                            <input class="form-control d-none" id="projectImage" type="file" accept="image/*"
                                name="projectImg" onchange="preview()">
                            <div
                                class="img-box  overflow-hidden position-relative d-flex align-items-center justify-content-center">
                                <img src="{{ $project->projectImg ? asset('storage/' . $project->projectImg) : asset('images/no-image.png') }}"
                                    alt="" class="w-100 h-100 object-fit-cover " id="frame">
                                <i id="add-logo" class="d-none">
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
                <div class="row m-0 form-row ">
                    <div class="col-auto label-container">
                        <label for="projectName">Project Name</label>
                    </div>
                    <div class="col">
                        <input type="text" name="projectName" id="projectName" class="modal-input-border"
                            value="{{ $project->projectName }}">
                    </div>
                </div>
                <div class="row m-0 form-row">
                    <div class="col-auto label-container">
                        <label for="projectDetails">Details</label>
                    </div>
                    <div class="col">
                        <textarea name="projectDetails" id="projectDetails" maxlength="200" class="modal-input-border">{{ $project->projectDetails }}</textarea>
                    </div>
                </div>
                <div class="row m-0 form-row">
                    <div class="col-auto label-container">
                        <label for="status">Status</label>
                    </div>
                    <div class="col" id="project-status" data-project-status="{{ $project->status }}">
                        <select name="status" id="status">
                            <option value="INCOMPLETE" id="incomplete"
                                {{ $project->status == 'incomplete' ? 'selected ' : '' }}>
                                Incomplete
                            </option>
                            <option value="ONGOING" id="ongoing"
                                {{ $project->status == 'ONGOING' ? 'selected' : '' }}>
                                Ongoing</option>
                            <option value="COMPLETE" id="complete"
                                {{ $project->status == 'COMPLETE' ? 'selected' : '' }}>Complete</option>
                        </select>
                    </div>
                </div>
                <div class="row m-0 form-row ">
                    <div class="col-auto label-container">
                        <label for="testerName">Add New Tester</label>
                    </div>
                    <div class="col">
                        <input type="text" name="tester" id="tester" class="modal-input-border">
                    </div>
                </div>
            </div>
            <div class="btn-container">
                <button class="btn red " data-bs-target="#modal-delete-project" data-bs-toggle="modal"
                    data-bs-dismiss="modal" type="button">Delete project</button>
                <button class="btn blue">Save Changes</button>
            </div>
        </x-modal-form>
    </x-modal-content>
</x-modal-layout>
@include('projects.destroy', ['project' => $project])
