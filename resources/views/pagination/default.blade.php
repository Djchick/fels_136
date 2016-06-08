<div class="total-result pull-left">
    {{ trans('pagination.total', ['total' => $paginator->total()]) }}
</div>
{{ $paginator->links() }}
