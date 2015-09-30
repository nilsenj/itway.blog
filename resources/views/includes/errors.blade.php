    @if (count($errors) > 0)
        <div class="error closable">
            <div class="close"><div class="icon-close"></div></div>
        <div class="text-center">
            <ul class="inline">
                <strong>
                <li><strong>WT hack!</strong> Problems apeared!</li>
                @foreach ($errors->all() as $error)
                    <li class="text-grey">{{ $error }}</li>
                @endforeach
                </strong>
            </ul>
        </div>
        </div>
    @endif
