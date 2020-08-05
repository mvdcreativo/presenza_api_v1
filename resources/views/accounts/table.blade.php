<div class="table-responsive">
    <table class="table" id="accounts-table">
        <thead>
            <tr>
                <th>User Id</th>
        <th>Dni</th>
        <th>Phone</th>
        <th>Movil</th>
        <th>Address</th>
        <th>Address2</th>
        <th>Company</th>
        <th>Cuit</th>
        <th>Image</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($accounts as $account)
            <tr>
            <td class="align-middle">{{ $account->user_id }}</td>
            <td class="align-middle">{{ $account->dni }}</td>
            <td class="align-middle">{{ $account->phone }}</td>
            <td class="align-middle">{{ $account->movil }}</td>
            <td class="align-middle">{{ $account->address }}</td>
            <td class="align-middle">{{ $account->address2 }}</td>
            <td class="align-middle">{{ $account->company }}</td>
            <td class="align-middle">{{ $account->cuit }}</td>
            <td class="align-middle"><img width="80px" src="{{ $account->image }}" alt="{{ $account->image }}"></td>
                <td  class="align-middle">
                    {!! Form::open(['route' => ['accounts.destroy', $account->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('accounts.show', [$account->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('accounts.edit', [$account->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
