<div class="form-group">
    <label for="name">{{ __('Name') }}:</label>
    <input type="text" id="name" class="form-control" name="name" value="{{ $config['name'] }}">
</div>

<div class="form-group">
    <label for="number_display">{{ __('Number of products to display') }}:</label>
    <input type="number" id="number_display" class="form-control" name="number_display" value="{{ $config['number_display'] }}">
</div> 