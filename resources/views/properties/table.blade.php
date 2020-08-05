<div class="table-responsive">
    <table class="table" id="properties-table">
        <thead>
            <tr>
                <th>Title</th>
        <th>Code</th>
        <th>Description</th>
        <th>Status Id</th>
        <th>Property Type Id</th>
        <th>Neighborhood Id</th>
        <th>Latitude</th>
        <th>Longitude</th>
        <th>User Owner Id</th>
        <th>User Customer Id</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($properties as $property)
            <tr>
                <td>{{ $property->title }}</td>
            <td>{{ $property->code }}</td>
            <td>{{ $property->description }}</td>
            <td>{{ $property->status_id }}</td>
            <td>{{ $property->property_type_id }}</td>
            <td>{{ $property->neighborhood_id }}</td>
            <td>{{ $property->latitude }}</td>
            <td>{{ $property->longitude }}</td>
            <td>{{ $property->user_owner_id }}</td>
            <td>{{ $property->user_customer_id }}</td>
                <td>
                    {!! Form::open(['route' => ['properties.destroy', $property->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('properties.show', [$property->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('properties.edit', [$property->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
