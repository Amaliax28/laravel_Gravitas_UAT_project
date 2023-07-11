@props(['project'])
@props(['testers'])
<x-modal-layout id="edit-session-modal" class="modal-form">
    <x-modal-header>Edit session details</x-modal-header>
    <x-modal-content>
        <x-modal-form  action="/project/{{$session->projects_id}}/sessions/{{$session->id}}">
            @method('PUT')
            <div class="form-container ">
                <div class="row m-0 form-row ">
                    <div class="col-auto label-container">
                        <label for="sessionName">Session Name</label>
                    </div>
                    <div class="col">
                        <input type="text" name="sessionName" id="sessionName"
                            class="modal-input-border"   value="{{$session->sessionName}}">
                    </div>
                </div>
                <div class="row m-0 form-row ">
                    <div class="col-auto label-container">
                        <label for="sessionStartDate">Start date</label>
                    </div>
                    <div class="col">
                        <input type="date" name="sessionStartDate" id="sessionStartDate"
                            class="modal-input-border"  value="{{$session->sessionStartDate}}">
                    </div>
                </div>
                <div class="row m-0 form-row">
                    <div class="col-auto label-container">
                        <label for="sessionDesc">Details</label>
                    </div>
                    <div class="col">
                        <textarea name="sessionDesc" id="sessionDesc"  maxlength="200" class="modal-input-border">{{$session['sessionDesc']}}</textarea>
                    </div>
                </div>
                <div class="row m-0 form-row">
                    <div class="col-auto label-container">
                        <label for="status" id="status">Status</label>
                    </div>
                    <div class="col" id="project-status"  data-project-status="{{$session->status}}">
                        <select name="status" id="status">
                            <option value="INCOMPLETE" id="incomplete">Incomplete</option>
                            <option value="ONGOING" id="ongoing">Ongoing</option>
                            <option value="COMPLETE" id="complete">Complete</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="btn-container">
                <button class="btn red " data-bs-target="#modal-delete-project" data-bs-toggle="modal"
                    data-bs-dismiss="modal" type="button">Delete project</button>
                <button class="btn blue" >Save Changes</button>
            </div>
        </x-modal-form>
    </x-modal-content>
</x-modal-layout>
@include('projects.destroy',['project' => $project])
