<!--modal-create new project-->
<div tabindex="-1" role="dialog" {{$attributes->merge(['id' => '', 'class' => 'modal fade modal-fullscreen-sm-down'])}}>
    <div class="modal-dialog modal-dialog-centered modal-dialog-content" role="document">
        <div class="modal-content border-0 ">
            <div class="modal-body py-0">
                <div class="container-fluid p-0 w-100 ">
                    {{$slot}}
                </div>
            </div>
        </div>
    </div>
</div>



