<div class="catalog_bottom_pages">
	{{ $items->appends(Request::except('page'))->links('partials/zurb_presenter') }}
</div>