<li><a href='{{ URL::to($entity->uri) }}'>{{ $entity->name }}</a>@if($entity->entities())
		<ul>
			@each('monal-sitemap::entity', $entity->entities(), 'entity')
		</ul>
	@endif
</li>