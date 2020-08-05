<div class="table-responsive">
    <table class="table" id="taxes-table">
        <thead>
            <tr>
                <th>Name</th>
        <th>Value</th>
        <th>Abbr</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($taxes as $tax)
            <tr>
                <td>{{ $tax->name }}</td>
            <td>{{ $tax->value }}</td>
            <td>{{ $tax->abbr }}</td>
                <td>
                    {!! Form::open(['route' => ['taxes.destroy', $tax->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('taxes.show', [$tax->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('taxes.edit', [$tax->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
