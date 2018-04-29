<!-- Title Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::textarea('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Options Field -->
<div class="form-group col-sm-6">
    {!! Form::label('options', 'Options:') !!}
    {!! Form::text('options', null, ['class' => 'form-control']) !!}
</div>

<!-- Positive Feddback Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('positive_feddback', 'Positive Feddback:') !!}
    {!! Form::textarea('positive_feddback', null, ['class' => 'form-control']) !!}
</div>

<!-- Feddback Positive Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('feddback_positive', 'Feddback Positive:') !!}
    {!! Form::textarea('feddback_positive', null, ['class' => 'form-control']) !!}
</div>

<!-- Feddback Wrong Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('feddback_wrong', 'Feddback Wrong:') !!}
    {!! Form::textarea('feddback_wrong', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::select('status', ['0' => 'Inactive', '1' => 'Active', '2' => 'Pending', '3' => 'Rejected', '4' => 'Deleted'], null, ['class' => 'form-control']) !!}
</div>

<!-- Category Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('category_id', 'Category Id:') !!}
    {!! Form::text('category_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('questions.index') !!}" class="btn btn-default">Cancel</a>
</div>
