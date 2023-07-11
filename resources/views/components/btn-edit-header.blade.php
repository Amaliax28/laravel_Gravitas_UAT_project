@props(['project'])
@props(['testers'])
<div class="btn-container ">
    <button class="btn blue-border" data-bs-target="#edit-project-modal-{{ $project->id }}" data-bs-toggle="modal"
        type="button">Edit project
    </button>
</div>
