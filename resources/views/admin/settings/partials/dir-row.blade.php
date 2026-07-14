<div class="link-row">
    <input type="text" name="dir_label[]" class="form-control" placeholder="Label (e.g. Parliamentary Board)" value="{{ $label ?? '' }}">
    <input type="text" name="dir_slug[]"  class="form-control" placeholder="Slug (e.g. national-parliamentary-board)" value="{{ $slug ?? '' }}">
    <button type="button" class="btn-remove-row" onclick="removeRow(this)">✕ Remove</button>
</div>
