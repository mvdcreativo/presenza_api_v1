<div class="table-responsive">
    <table class="table" id="provinces-table">
        <thead>
            <tr>
                <th>Name</th>
        <th>Code</th>
        <th>Country Id</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($provinces as $province)
            <tr>
                <td>{{ $province->name }}</td>
            <td>{{ $province->code }}</td>
            <td>{{ $province->country_id }}</td>
                <td>
                    {!! Form::open(['route' => ['provinces.destroy', $province->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('provinces.show', [$province->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('provinces.edit', [$province->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
