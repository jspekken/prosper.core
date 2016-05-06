<div class="col-{{ $node->width }}">
    @foreach ($node->getChildren() as $child)
        {!! $child->render() !!}
    @endforeach
</div>