@php /** @var \App\Entity\Characteristic $characteristic */ @endphp

<div class="form-group">
    <label for="characteristics[{{ $characteristic->id }}]">{{ $characteristic->name }}</label>
    <input type="text" class="form-control" name="characteristics[{{ $characteristic->id }}]" id="characteristics[{{ $characteristic->id }}]" value="{{ $value ?? '' }}">
</div>
