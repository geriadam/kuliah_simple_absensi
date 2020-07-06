@if (Route::getCurrentRoute()->getActionMethod() == 'create')
    {{ Form::open(['route' => $create, 'files' => true]) }}
@endif
@if (Route::getCurrentRoute()->getActionMethod() == 'edit' && $data)
    {{ Form::open(['route' => [$update, $data], 'method' => 'PUT', 'files' => true]) }}
@endif
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            @if(!is_null(@$back))
                                <a href="{{ route($back) }}" class="btn btn-shadow btn-primary"><i class="pe-7s-left-arrow btn-icon-wrapper"> </i> Back</a>
                            @else
                                <a href="{{ URL::previous() }}" class="btn btn-shadow btn-primary"><i class="pe-7s-left-arrow btn-icon-wrapper"> </i> Back</a>
                            @endif
                            @if (Route::getCurrentRoute()->getActionMethod() == 'create')
                                <button type="submit" class="btn btn-success"><i class="lnr-database btn-icon-wrapper"> </i>Save</button>
                            @endif
                            @if (Route::getCurrentRoute()->getActionMethod() == 'edit' && $data)
                                <button type="submit" class="btn btn-success"><i class="lnr-pencil btn-icon-wrapper"> </i>Update</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
