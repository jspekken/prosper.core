<div class="row">
    @foreach ($node->getChildren() as $child)
        {!! $child->render() !!}
    @endforeach
</div>