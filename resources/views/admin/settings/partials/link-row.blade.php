<div class="link-row">
    <input type="text" name="useful_label[]" class="form-control" placeholder="Link Label (e.g. Home)" value="{{ $label ?? '' }}">
    <input type="url"  name="useful_url[]"   class="form-control" placeholder="URL (e.g. /contact-us)" value="{{ $url ?? '' }}">
    <button type="button" class="btn-remove-row" onclick="removeRow(this)">✕ Remove</button>
</div>
