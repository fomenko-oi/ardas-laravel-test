@php /** @var \App\Entity\Characteristic $characteristic */ @endphp

<div class="form-group">
    <label for="characteristics[{{ $characteristic->id }}]">{{ $characteristic->name }}</label>
    <select class="form-control" id="characteristics[{{ $characteristic->id }}]" name="characteristics[{{ $characteristic->id }}]">
        <option value=""></option>

        @foreach($characteristic->getOptions() as $option)
            <option {{ isset($value) && $value === $option ? 'selected' : '' }}>{{ $option }}</option>
        @endforeach

    </select>
</div>
