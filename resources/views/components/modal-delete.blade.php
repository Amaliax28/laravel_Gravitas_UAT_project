@props(['data'])
@props(['name'])
@props(['action'])
<x-modal-layout id="modal-delete-{{$name}}-{{$data['id']}}" class="modal-delete">
    <!--FORM-->
    <div class="row ">
        <div class="col title">
            Delete {{$name}}?
        </div>
    </div>
    <div class="row">
        <div class="col desc">
            Are you sure to delete  {{$data->username ? $data->username : 'this'}}?
        </div>
    </div>
    <div class="row">
        <div class="col">
            <form method="POST" action="{{$action}}">
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
