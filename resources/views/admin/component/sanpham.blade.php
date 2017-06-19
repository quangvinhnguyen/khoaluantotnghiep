<div class="row">
    @foreach ($datas as $item)
        <div class="col-xs-12 col-sm-6 col-md-3">
            <div class="col-item">
                <div class="post-img-content">
                </div>
                <div class="info">
                    <div class="row">
                        <div class="price col-md-6">
                            <h5>{{ $item->ten_sp }}</h5>
                        </div>
                    </div>
                    <div class="separator clear-left">
                        {{ Form::button('Add', [
                            'class' => 'btn-add fa fa fa-exchange',
                            'value' => $item,
                        ]) }}
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    @endforeach
    {{ $datas->links() }}
</div>
