@props(['tester'])
<x-modal-layout id="modal-delete-user" class="modal-delete">
    <!--FORM-->
    <div class="row ">
        <div class="col title">
            Remove user?
        </div>
    </div>
    <div class="row">
        <div class="col desc">
            Are you sure to remove {{$tester->username}} from this project?
        </div>
    </div>
    <div class="row">
        <div class="col">
            <form method="POST" action="/project/{{$project->id}}/tester/{{$tester->id}}/remove">
                @csrf
                @method('DELETE')
                <div class="btn-container">
                    <button class="btn white" type="button"  data-bs-dismiss="modal">No, cancel</button>
                    <button class="btn red" >Yes, remove</button>
                </div>
            </form>
        </div>
    </div>

</x-modal-layout>
