@if ($message = Session::get('success'))
    <x-flash type="success" dismiss="yes">{{ $message }}</x-flash>
@endif

@if ($message = Session::get('error'))
    <x-flash type="error" dismiss="yes">{{ $message }}</x-flash>
@endif

@if ($message = Session::get('warning'))
    <x-flash type="warning" dismiss="yes">{{ $message }}</x-flash>
@endif

@if ($message = Session::get('info'))
    <x-flash type="info" dismiss="yes">{{ $message }}</x-flash>
@endif

@if ($errors->any())
    <x-flash type="error" dismiss="yes">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </x-flash>
@endif
