@props(['session'])
<x-modal-layout id="modal-delete-session-{{$session->id}}" class="modal-delete">
    <!--FORM-->
    <div class="row ">
        <div class="col title">
            Delete session?
        </div>
    </div>
    <div class="row">
        <div class="col desc">
            Are you sure to delete this session?
        </div>
    </div>
    <div class="row">
        <div class="col">
            <form method="POST" action="/sessions/{{$session->projects_id}}/{{$session->id}}">
                @csrf
                @method('DELETE')
                <div class="btn-container">
                    <button class="btn white" type="button"  data-bs-dismiss="modal">No, cancel</button>
                    <button class="btn red" >Yes, delete</button>
                </div>
            </form>
        </div>
    </div>

</x-modal-layout>
