@props(['project'])
@props(['testers'])
<div class="btn-container ">
    <button class="btn blue-border" data-bs-target="#edit-project-modal-{{ $project->id }}" data-bs-toggle="modal"
        data-bs-toggle="tooltip" data-bs-placement="top" title="Edit This Project Details" type="button">Edit project
    </button>
</div>
