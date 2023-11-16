@props([
    'action',
    'post' =>null,
    'put' => null,
    'delete' => null
    
])

<form action="{{ $action }}" method="post">
@csrf

    @if($put)
        @method('PUT')
    @endif

    @if ($delete)
        @method('DELETE')
    @endif


    {{ $slot }}

</form>
