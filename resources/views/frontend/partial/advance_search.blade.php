<div class="col-md-12">
    {!! Form::open(['url' => 'search/', 'class' => 'content-search-view2', 'files' => true]) !!}
    <?php /*?>
    <div class="col-md-3">
            {!! FrontEnd::departmentSearch() !!}
        </div>
        <div class="col-md-3">
            {!! FrontEnd::serviceSearch() !!}
        </div>
        <div class="col-md-3">
            {!! FrontEnd::authorsSearch() !!}
        </div>
    <?php */?>
    <div class="input-group col-md-12">

        {!! Form::text('q', null, ['class' => 'form-control', 'placeholder'=>'Type your desired keyword', 'required' => 'required','id'=>'search']) !!}
        <input type="hidden" name="home" value="ok">
            <span class="input-group-btn">
    <button type="submit" id="submit" class="btn btn-primary">Search</button>
  </span>
        </div>
    {!! Form::close() !!}
</div>

