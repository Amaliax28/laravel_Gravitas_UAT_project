@props(['project'])
<x-modal-layout id="modal-delete-project" class="modal-delete">
    <!--FORM-->
    <div class="row ">
        <div class="col title">
            Delete project?
        </div>
    </div>
    <div class="row">
        <div class="col desc">
            Are you sure to delete this project?
        </div>
    </div>
    <div class="row">
        <div class="col">
            <form method="POST" action="/projects/{{$project->id}}">
                @csrf
                @method('DELETE')
                <div class="btn-container">
                    <button class="btn white" type="button" data-bs-dismiss="modal">No, cancel</button>
                    <button class="btn red" >Yes, delete</button>
                </div>
            </form>
        </div>
    </div>

</x-modal-layout>
