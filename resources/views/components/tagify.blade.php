<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />

@props(['tags'])

<style>
    .tags-look .tagify__dropdown__item {
        display: inline-block;
        vertical-align: middle;
        border-radius: 3px;
        padding: .3em .5em;
        border: 1px solid #CCC;
        background: #F3F3F3;
        margin: .2em;
        font-size: .85em;
        color: black;
        transition: 0s;
    }

    .tags-look .tagify__dropdown__item--active {
        border-color: black;
    }

    .tags-look .tagify__dropdown__item:hover {
        background: lightyellow;
        border-color: gold;
    }

    .tags-look .tagify__dropdown__item--hidden {
        max-width: 0;
        max-height: initial;
        padding: .3em 0;
        margin: .2em 0;
        white-space: nowrap;
        text-indent: -20px;
        border: 0;
    }
</style>

<input id="tagify" class='tagify--custom-dropdown w-full block' placeholder='tags' {{ $attributes->merge() }}>


<script>
    var input = document.getElementById('tagify'),
        // init Tagify script on the above inputs
        tagify = new Tagify(input, {
            whitelist: @json($tags),
            maxTags: 10,
            dropdown: {
                maxItems: 20, // <- mixumum allowed rendered suggestions
                classname: 'tags-look', // <- custom classname for this dropdown, so it could be targeted
                enabled: 0, // <- show suggestions on focus
                closeOnSelect: false // <- do not hide the suggestions dropdown once an item has been selected
            }
        })
</script>
