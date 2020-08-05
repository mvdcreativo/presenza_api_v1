<div class="table-responsive">
    <table class="table" id="images-table">
        <thead>
            <tr>
                <th>Url</th>
        <th>Title</th>
        <th>Subtitle</th>
        <th>Description</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($images as $image)
            <tr>
                <td>{{ $image->url }}</td>
            <td>{{ $image->title }}</td>
            <td>{{ $image->subtitle }}</td>
            <td>{{ $image->description }}</td>
                <td>
                    {!! Form::open(['route' => ['images.destroy', $image->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('images.show', [$image->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('images.edit', [$image->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
