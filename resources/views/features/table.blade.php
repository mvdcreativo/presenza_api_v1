<div class="table-responsive">
    <table class="table" id="features-table">
        <thead>
            <tr>
                <th>Name</th>
        <th>Feature Id</th>
        <th>Type</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($features as $feature)
            <tr>
                <td>{{ $feature->name }}</td>
            <td>{{ $feature->feature_id }}</td>
            <td>{{ $feature->type }}</td>
                <td>
                    {!! Form::open(['route' => ['features.destroy', $feature->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('features.show', [$feature->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('features.edit', [$feature->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
