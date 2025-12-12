@props(['name', 'class' => 'w-12 h-12'])

@php
    $path = public_path('images/icons/' . $name . '.svg');
    $svgContent = '';
    
    if (file_exists($path)) {
        $svgContent = file_get_contents($path);
        
        // Replace the hardcoded brown color with currentColor
        // The original color in the SVG is #553823
        $svgContent = str_replace('#553823', 'currentColor', $svgContent);
        
        // Ensure the SVG scales with the container
        // We remove width and height if they exist to let CSS control it
        $svgContent = preg_replace('/width="[\d\.]+"/', '', $svgContent);
        $svgContent = preg_replace('/height="[\d\.]+"/', '', $svgContent);
        
        // Inject the class and set fill to currentColor if not already set by replacement
        // We'll wrap it in a container that handles the sizing and color
    }
@endphp

<div class="{{ $class }} fill-current inline-block">
    {!! $svgContent !!}
</div>