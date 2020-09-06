<table class="table table-striped table-hover">
    <tr>
        <th>{{ trans('labels.backend.zclists.tabs.content.overview.referenceCode') }}</th>
        <td>{!! $zclist->referenceCode !!}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.zclists.tabs.content.overview.name') }}</th>
        <td>{!! $zclist->name !!}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.zclists.tabs.content.overview.ownerCode') }}</th>
        <td>{!! $zclist->ownerCode !!}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.zclists.tabs.content.overview.listtype_id') }}</th>
        <td>{!! $listtype !!}</td>
    </tr>
    
    <tr>
        <th>{{ trans('labels.backend.zclists.tabs.content.overview.description') }}</th>
        <td>{!! $zclist->description !!}</td>
    </tr>
    
    <tr>
        <th>{{ trans('labels.backend.zclists.tabs.content.overview.createdDateUtc') }}</th>
        <td>{!! $zclist->createdDateUtc !!}</td>
    </tr>
    
    <tr>
        <th>{{ trans('labels.backend.zclists.tabs.content.overview.lastUpdatedDateUtc') }}</th>
        <td>{!! $zclist->lastUpdatedDateUtc !!}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.zclists.tabs.content.overview.isShared') }}</th>
        <td>{!! $zclist->isShared ? 'YES' : 'NO' !!}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.zclists.tabs.content.overview.isPublic') }}</th>
        <td>{!! $zclist->isPublic ? 'YES' : 'NO' !!}</td>
    </tr>
    
    <tr>
        <th>{{ trans('labels.backend.zclists.tabs.content.overview.url') }}</th>
        <td>{!! $zclist->url !!}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.zclists.tabs.content.overview.created_at') }}</th>
        <td>{{ $zclist->created_at }} ({{ $zclist->created_at->diffForHumans() }})</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.zclists.tabs.content.overview.last_updated') }}</th>
        <td>{{ $zclist->updated_at }} ({{ $zclist->updated_at->diffForHumans() }})</td>
    </tr>

    @if ($zclist->trashed())
        <tr>
            <th>{{ trans('labels.backend.zclists.tabs.content.overview.deleted_at') }}</th>
            <td>{{ $zclist->deleted_at }} ({{ $zclist->deleted_at->diffForHumans() }})</td>
        </tr>
    @endif
</table>