<x-modal-layout id="new-project-modal" class="modal-form ">
    <x-modal-header>Create new session</x-modal-header>
    <x-modal-content>
        <x-modal-form action="/project/{{$project['id']}}/sessions/create" id="modal-form">
            <div class="form-container ">
                <div class="row m-0 form-row ">
                    <div class="col-auto label-container">
                        <label for="sessionName">Session Name</label>
                    </div>
                    <div class="col">
                        <input type="text" name="sessionName" id="sessionName" class="modal-input-border">
                    </div>
                </div>
                <div class="row m-0 form-row ">
                    <div class="col-auto label-container">
                        <label for="sessionStartDate">Start date</label>
                    </div>
                    <div class="col">
                        <input type="date" name="sessionStartDate" id="sessionStartDate" class="modal-input-border">
                    </div>
                </div>
                <div class="row m-0 form-row">
                    <div class="col-auto label-container">
                        <label for="sessionDesc">Details</label>
                    </div>
                    <div class="col">
                        <textarea name="sessionDesc" id="sessionDesc" class="modal-input-border"  maxlength="200"></textarea>
                    </div>
                </div>
                <div class="row m-0 form-row">
                    <div class="col-auto label-container">
                        <label for="status">Status</label>
                    </div>
                    <div class="col">
                        <select name="status" id="status">
                            <option value="INCOMPLETE">Incomplete</option>
                            <option value="ONGOING">Ongoing</option>
                            <option value="COMPLETE">Complete</option>
                        </select>
                    </div>
                </div>
            </div>
            <x-button-modal>
                Create Session
            </x-button-modal>
        </x-modal-form>
    </x-modal-content>
</x-modal-layout>
<script>
    //DISABLE BUTTON UNTILL ALL FIELDS ARE FILLED
    const form = document.getElementById("modal-form");
    const submitBtn = document.getElementById("submitBtn");
    const inputs = form.querySelectorAll("input,textarea");
    inputs.forEach((input) => {
        input.addEventListener("input", () => {
            const allFilled = [...inputs].every((input) => input.value !== "");
            submitBtn.disabled = !allFilled;
        });
    });
</script>
