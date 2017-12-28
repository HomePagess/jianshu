<?php
/*
 * !
 * saveremoteimg demo for php
 * @requires xhEditor
 *
 * @author Yanis.Wang<yanis.wang@gmail.com>
 * @site http://xheditor.com/
 * @licence LGPL(http://www.opensource.org/licenses/lgpl-license.php)
 *
 * @Version: 0.9.2 (build 110712)
 *
 * ע����������Ϊ��ʾ�ã�ֻʵ�������򵥵�Զ��ץͼ��ճ���ϴ�������Ҫ���ƴ˹��ܣ�����Ҫ���п������¹��ܣ�
 * 1����ͼƬ��չ����URL��ַץȡ
 * 2����������ͼƬתjpg��ʽ���Լ���ˮӡ�Ⱥ�������
 * 3���ϴ���¼�������ݿ��Թ����û��ϴ�ͼƬ
 */
header('Content-Type: text/html; charset=UTF-8');
$attachDir = 'upload'; // �ϴ��ļ�����·������β��Ҫ��/
$dirType = 1; // 1:��������Ŀ¼ 2:���´���Ŀ¼ 3:����չ����Ŀ¼ ����ʹ�ð�����
$maxAttachSize = 2097152; // �����ϴ���С��Ĭ����2M
$upExt = "jpg,jpeg,gif,png"; // �ϴ���չ��
ini_set('date.timezone', 'Asia/Shanghai');
 // ʱ��
                                          
// ����Զ���ļ�
function saveRemoteImg($sUrl)
{
    global $upExt, $maxAttachSize;
    $reExt = '(' . str_replace(',', '|', $upExt) . ')';
    if (substr($sUrl, 0, 10) == 'data:image') { // base64������ͼƬ�����ܳ�����firefoxճ��������ĳЩ��վ�ϣ�����googleͼƬ
        if (! preg_match('/^data:image\/' . $reExt . '/i', $sUrl, $sExt))
            return false;
        $sExt = $sExt[1];
        $imgContent = base64_decode(substr($sUrl, strpos($sUrl, 'base64,') + 7));
    } else { // urlͼƬ
        if (! preg_match('/\.' . $reExt . '$/i', $sUrl, $sExt))
            return false;
        $sExt = $sExt[1];
        $imgContent = getUrl($sUrl);
    }
    if (strlen($imgContent) > $maxAttachSize)
        return false; // �ļ�����������������
    $sLocalFile = getLocalPath($sExt);
    file_put_contents($sLocalFile, $imgContent);
    // ����mime�Ƿ�ΪͼƬ����Ҫphp.ini�п���gd2��չ
    $fileinfo = @getimagesize($sLocalFile);
    if (! $fileinfo || ! preg_match("/image\/" . $reExt . "/i", $fileinfo['mime'])) {
        @unlink($sLocalFile);
        return false;
    }
    return $sLocalFile;
}

// ץURL����
function getUrl($sUrl, $jumpNums = 0)
{
    $arrUrl = parse_url(trim($sUrl));
    if (! $arrUrl)
        return false;
    $host = $arrUrl['host'];
    $port = isset($arrUrl['port']) ? $arrUrl['port'] : 80;
    $path = $arrUrl['path'] . (isset($arrUrl['query']) ? "?" . $arrUrl['query'] : "");
    $fp = @fsockopen($host, $port, $errno, $errstr, 30);
    if (! $fp)
        return false;
    $output = "GET $path HTTP/1.0\r\nHost: $host\r\nReferer: $sUrl\r\nConnection: close\r\n\r\n";
    stream_set_timeout($fp, 60);
    @fputs($fp, $output);
    $Content = '';
    while (! feof($fp)) {
        $buffer = fgets($fp, 4096);
        $info = stream_get_meta_data($fp);
        if ($info['timed_out'])
            return false;
        $Content .= $buffer;
    }
    @fclose($fp);
    global $jumpCount; // �ض���
    if (preg_match("/^HTTP\/\d.\d (301|302)/is", $Content) && $jumpNums < 5) {
        if (preg_match("/Location:(.*?)\r\n/is", $Content, $murl))
            return getUrl($murl[1], $jumpNums + 1);
    }
    if (! preg_match("/^HTTP\/\d.\d 200/is", $Content))
        return false;
    $Content = explode("\r\n\r\n", $Content, 2);
    $Content = $Content[1];
    if ($Content)
        return $Content;
    else
        return false;
}

// ���������ر����ļ�·��
function getLocalPath($sExt)
{
    global $dirType, $attachDir;
    switch ($dirType) {
        case 1:
            $attachSubDir = 'day_' . date('ymd');
            break;
        case 2:
            $attachSubDir = 'month_' . date('ym');
            break;
        case 3:
            $attachSubDir = 'ext_' . $sExt;
            break;
    }
    $newAttachDir = $attachDir . '/' . $attachSubDir;
    if (! is_dir($newAttachDir)) {
        @mkdir($newAttachDir, 0777);
        @fclose(fopen($newAttachDir . '/index.htm', 'w'));
    }
    PHP_VERSION < '4.2.0' && mt_srand((double) microtime() * 1000000);
    $newFilename = date("YmdHis") . mt_rand(1000, 9999) . '.' . $sExt;
    $targetPath = $newAttachDir . '/' . $newFilename;
    return $targetPath;
}

$arrUrls = explode('|', $_POST['urls']);
$urlCount = count($arrUrls);
for ($i = 0; $i < $urlCount; $i ++) {
    $localUrl = saveRemoteImg($arrUrls[$i]);
    if ($localUrl)
        $arrUrls[$i] = $localUrl;
}
echo implode('|', $arrUrls);

?>