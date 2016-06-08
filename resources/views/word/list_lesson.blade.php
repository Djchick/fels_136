@foreach ($lessons as $key => $lesson)
    <option value="{!! $lesson["id"] !!}">{!! $lesson["name"] !!}</option>
@endforeach