{{-- "Bundle" nav item: today's Pricing + Membership sections shown together.
     Each keeps its own <section> wrapper/id (#harga, #keanggotaan) untouched
     so existing internal links/anchors keep working; this file just merges
     them under the single new "Bundle" nav entry (which points at #harga). --}}
@include('partials.pricing')
@include('partials.membership')
