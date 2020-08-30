<table class="table table-striped table-hover">
    <tr>
        <th>{{ trans('labels.backend.sponsors.tabs.content.overview.name') }}</th>
        <td>{{ $sponsor->name }}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.sponsors.tabs.content.overview.relatedWebPage') }}</th>
        <td>{!! $sponsor->relatedWebPage !!}</td>
    </tr>
    
    <tr>
        <th>{{ trans('labels.backend.sponsors.tabs.content.overview.relatedWebPageText') }}</th>
        <td>{!! $sponsor->relatedWebPageText !!}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.sponsors.tabs.content.overview.created_at') }}</th>
        <td>{{ $sponsor->created_at }} ({{ $sponsor->created_at->diffForHumans() }})</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.sponsors.tabs.content.overview.last_updated') }}</th>
        <td>{{ $sponsor->updated_at }} ({{ $sponsor->updated_at->diffForHumans() }})</td>
    </tr>

    @if ($sponsor->trashed())
        <tr>
            <th>{{ trans('labels.backend.sponsors.tabs.content.overview.deleted_at') }}</th>
            <td>{{ $sponsor->deleted_at }} ({{ $sponsor->deleted_at->diffForHumans() }})</td>
        </tr>
    @endif
</table>