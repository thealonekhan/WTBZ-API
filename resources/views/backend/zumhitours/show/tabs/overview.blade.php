<table class="table table-striped table-hover">
    <tr>
        <th>{{ trans('labels.backend.zumhitours.tabs.content.overview.referenceCode') }}</th>
        <td>{{ $zumhitour->referenceCode }}</td>
    </tr>
    
    <tr>
        <th>{{ trans('labels.backend.zumhitours.tabs.content.overview.name') }}</th>
        <td>{{ $zumhitour->name }}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.zumhitours.tabs.content.overview.coordinates_id') }}</th>
        <td>{!! $coordinates !!}</td>
    </tr>
   
    <tr>
        <th>{{ trans('labels.backend.zumhitours.tabs.content.overview.zumhicaches') }}</th>
        <td>
            @if(!empty($zumhicaches))
                @foreach($zumhicaches as $zumhicache)
                    <label class="label label-info">{!! $zumhicache->referenceCode . ' - ' .$zumhicache->name !!}</label>
                @endforeach
            @endif
        </td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.zumhitours.tabs.content.overview.sponsor_id') }}</th>
        <td>{!! $sponsor !!}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.zumhitours.tabs.content.overview.description') }}</th>
        <td>{!! $zumhitour->description !!}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.zumhitours.tabs.content.overview.url') }}</th>
        <td>{!! $zumhitour->url !!}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.zumhitours.tabs.content.overview.coverImageUrl') }}</th>
        <td>{!! $zumhitour->coverImageUrl !!}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.zumhitours.tabs.content.overview.logoImageUrl') }}</th>
        <td>{!! $zumhitour->logoImageUrl !!}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.zumhitours.tabs.content.overview.created_at') }}</th>
        <td>{{ $zumhitour->created_at }} ({{ $zumhitour->created_at->diffForHumans() }})</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.zumhitours.tabs.content.overview.last_updated') }}</th>
        <td>{{ $zumhitour->updated_at }} ({{ $zumhitour->updated_at->diffForHumans() }})</td>
    </tr>

    @if ($zumhitour->trashed())
        <tr>
            <th>{{ trans('labels.backend.zumhitours.tabs.content.overview.deleted_at') }}</th>
            <td>{{ $zumhitour->deleted_at }} ({{ $zumhitour->deleted_at->diffForHumans() }})</td>
        </tr>
    @endif
</table>