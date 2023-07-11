<?php
header('Content-type: text/html; charset=utf-8');
$url = $_POST['url'] ? $_POST['url'] : 'https://new.torrentino.org/';
$content =  file_get_contents($url);
if(strpos($content, 'Windows-1251'))
    $content = iconv("windows-1251", "utf-8",$content);
$content = str_replace('src="/', 'src="https://new.torrentino.org/', $content);
$content = str_replace('href="/', 'href="https://new.torrentino.org/', $content);
// echo "<pre>";
// print_r($_SERVER);
// echo "</pre>";
echo $content;
?>

<script>
    var save = document.querySelector(".download-torrent");
    if(save !== null) {
        save.addEventListener('click', e => {
            e.preventDefault()
            let data = {
                torrent: save.href
            };

            fetch('/download.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(result => {
                if(result.status == 'success') {
                    alert('Торрент скачен');
                }
            })
            .catch(error => {
                console.error('Ошибка:', error);
            });
        })
    }
    
    document.addEventListener('click', e => {
        e.preventDefault()
        if (e.target.nodeName === 'A' && e.target.className != 'download-torrent') {
            let originalStr = e.target.href;
            let newStr = originalStr.replace('http://<?=$_SERVER['SERVER_ADDR'];?>', 'https://new.torrentino.org/');
            console.log(newStr);
            let form = document.createElement('form');
            form.action = 'http://<?=$_SERVER['SERVER_ADDR'];?>';
            form.method = 'POST';
            form.innerHTML = `<input name="url" value="${newStr}">`;
            document.body.append(form);
            form.submit();
        }
    })


</script>
