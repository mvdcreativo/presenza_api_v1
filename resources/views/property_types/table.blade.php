<div class="table-responsive">
    <table class="table" id="propertyTypes-table">
        <thead>
            <tr>
                <th>Name</th>
        <th>Description</th>
        <th>Status Id</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($propertyTypes as $propertyType)
            <tr>
                <td>{{ $propertyType->name }}</td>
            <td>{{ $propertyType->description }}</td>
            <td>{{ $propertyType->status_id }}</td>
                <td>
                    {!! Form::open(['route' => ['propertyTypes.destroy', $propertyType->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('propertyTypes.show', [$propertyType->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('propertyTypes.edit', [$propertyType->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
