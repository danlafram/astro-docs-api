<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    });

    window.customConfig = {
        assetManager: {
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        }
    };

    const escapeName = (name) => `${name}`.trim().replace(/([^a-z0-9\w-:/\[\]]+)/gi, '-');
    window.customConfig = { selectorManager: {escapeName}, }; 
</script>