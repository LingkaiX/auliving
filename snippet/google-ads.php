<script async='async' src='https://www.googletagservices.com/tag/js/gpt.js'></script>
<script>
  var googletag = googletag || {};
  googletag.cmd = googletag.cmd || [];
</script>

<script>
  googletag.cmd.push(function() {
    // Create the measurement node
    var scrollDiv = document.createElement("div");
    scrollDiv.style.overflow = 'scroll';
    document.body.appendChild(scrollDiv);
    // Get the scrollbar width
    var scrollbarWidth = scrollDiv.offsetWidth - scrollDiv.clientWidth;
    var adjustedWidth= 992-scrollbarWidth || 992; 
    // Delete the DIV 
    document.body.removeChild(scrollDiv);

    var mapping1 = googletag.sizeMapping().
        addSize([adjustedWidth, 100], [728, 90]).
        addSize([0, 0], [320, 50]).
        build();
    var mapping2 = googletag.sizeMapping().
        addSize([adjustedWidth, 100], [300, 250]).
        addSize([0, 0], [320, 50]).
        build();
    var mapping3 = googletag.sizeMapping().
        addSize([adjustedWidth, 100], [468, 60]).
        addSize([0, 0], [320, 50]).
        build();
    var mapping4 = googletag.sizeMapping().
        addSize([adjustedWidth, 100], [1024, 768]).
        addSize([0, 0], [320, 480]).
        build();
    var mapping5 = googletag.sizeMapping().
        addSize([adjustedWidth, 100], [468, 60]).
        addSize([0, 0], [300, 250]).
        build();

    googletag.defineSlot('/21666183985/aulv/aulv-h1', [[320, 50], [728, 90]], 'div-gpt-ad-1543362254773-0').
        defineSizeMapping(mapping1).setCollapseEmptyDiv(true).addService(googletag.pubads());
    googletag.defineSlot('/21666183985/aulv/aulv-lb', [[320, 50], [728, 90]], 'div-gpt-ad-1543362198289-0').
        defineSizeMapping(mapping1).setCollapseEmptyDiv(true).addService(googletag.pubads());
    googletag.defineSlot('/21666183985/aulv/aulv-a1', [[300, 250], [468, 60]], 'div-gpt-ad-1582517809274-0').
        defineSizeMapping(mapping5).setCollapseEmptyDiv(true).addService(googletag.pubads());
    // googletag.defineSlot('/21666183985/aulv/aulv-a1', [[320, 50], [468, 60]], 'div-gpt-ad-1543361528497-0').
    //     defineSizeMapping(mapping3).setCollapseEmptyDiv(true).addService(googletag.pubads());
    googletag.defineSlot('/21666183985/aulv/aulv-a2', [[300, 250], [320, 50]], 'div-gpt-ad-1543362712099-0').
        defineSizeMapping(mapping2).setCollapseEmptyDiv(true).addService(googletag.pubads());
    googletag.defineSlot('/21666183985/aulv/aulv-a3', [[300, 250], [320, 50]], 'div-gpt-ad-1543362805047-0').
        defineSizeMapping(mapping2).setCollapseEmptyDiv(true).addService(googletag.pubads());
    googletag.defineSlot('/21666183985/aulv/aulv-s1', [[320, 50], [300, 250]], 'div-gpt-ad-1543363024514-0').
        defineSizeMapping(mapping2).setCollapseEmptyDiv(true).addService(googletag.pubads());
    googletag.defineSlot('/21666183985/aulv/aulv-s2', [[320, 50], [300, 250]], 'div-gpt-ad-1543363051079-0').
        defineSizeMapping(mapping2).setCollapseEmptyDiv(true).addService(googletag.pubads());
    googletag.defineSlot('/21666183985/aulv/aulv-s3', [[300, 250], [320, 50]], 'div-gpt-ad-1543363074255-0').
        defineSizeMapping(mapping2).setCollapseEmptyDiv(true).addService(googletag.pubads());
    googletag.defineSlot('/21666183985/aulv/aulv-l1', [160, 600], 'div-gpt-ad-1550722293026-0').addService(googletag.pubads());
    googletag.defineSlot('/21666183985/aulv/aulv-r1', [160, 600], 'div-gpt-ad-1550722764755-0').addService(googletag.pubads());
    googletag.defineSlot('/21666183985/aulv/aulv-bottom-fixed', [[320, 50], [728, 90]], 'div-gpt-ad-1562633073617-0').
        defineSizeMapping(mapping1).setCollapseEmptyDiv(true).addService(googletag.pubads());
    googletag.defineSlot('/21666183985/aulv/float-ad', [[320, 480], [1024, 768]], 'div-gpt-ad-1575955616703-0').
        defineSizeMapping(mapping4).setCollapseEmptyDiv(true).addService(googletag.pubads());
    googletag.pubads().enableSingleRequest();
    googletag.enableServices();
  });
</script>