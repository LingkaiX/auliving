<html lang=<?php echo isTCN()? 'cmn-hant':'cmn-hans'; ?>>
<head>
<meta charset="UTF-8">
</head>
<body>
<strong>对不起！我们没有找到你要的页面，正在返回主页......</strong>
<script>
    var url = "<?php echo getBaseUrl(true);?>";
    window.location.replace(url);
</script>
</body>
</html>