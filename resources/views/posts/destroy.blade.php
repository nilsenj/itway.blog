{!! Form::open(array('class' => '', 'style'=>'width:auto;height:auto;display:inline;', 'method' => 'DELETE', 'url' => [route('itway::posts::delete', $post->id)])) !!}

{!! Form::submit('Delete', array('class' => 'button button-danger')) !!}

{!! Form::close() !!}