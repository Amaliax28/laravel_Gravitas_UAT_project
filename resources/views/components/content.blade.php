<div {{$attributes->merge(['class' => 'col min-vh-100 p-0 m-0 overflow-hidden'])}}>
    <div class="content-area d-flex flex-column h-100">
        {{$slot}}
    </div>
</div>
