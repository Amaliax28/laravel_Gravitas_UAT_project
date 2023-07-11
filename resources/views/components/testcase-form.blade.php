<form method="POST" {{$attributes->merge(['action' => ''])}} >
    @csrf
    {{$slot}}
</form>
