 <!--FORM-->
 <form method="POST"   {{$attributes->merge(['id' => '', 'action' => '', 'class' => ''])}} enctype="multipart/form-data">
    @csrf
        {{$slot}}
 </form>
