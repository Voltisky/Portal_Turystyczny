<?php

namespace Backend\CommonBundle\Helper;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Yaml\Parser;

class MediaPathHelper {

    private $firstLevel;
    private $secondLevel;
    private $id;
    private $providerReference;

    public function __construct($id = null, $providerReference = null) {
	$this->firstLevel = 100000;
	$this->secondLevel = 1000;
	if ($id)
	{
	    $this->id = $id;
	    $this->providerReference = $providerReference;
	}
    }

    public function getMediaPath($m_id, $m_providerReference, $provider = "sonata.media.provider.image", $miniatura = false) {
	$rep_first_level = (int) ($m_id / $this->firstLevel);
	$rep_second_level = (int) (($m_id - ($rep_first_level * $this->firstLevel)) / $this->secondLevel);
	$path = '/media/default/%04s/%02s/%s';
	$providerReference = $m_providerReference;
	if ($miniatura == true)
	{
	    $providerNameArr = explode(".", $providerReference);
	    $ext = strtolower($providerNameArr[1]);

	    $videoTypes = array('wmv', 'mp4', 'mpg', 'mpeg', 'avi');

	    if ($provider == "sonata.media.provider.venevideo" || in_array($ext, $videoTypes))
	    {
		$providerReference = $providerNameArr[0] . "_miniatura.jpeg";
	    }
	}

	return sprintf($path, $rep_first_level + 1, $rep_second_level + 1, $providerReference);
    }

    public function getMediaPathVideo($mId, $mProviderReference, $container) {
	$versionTypes = array("_very_low.mp4" => array(144, "video/mp4"), "_low.mp4" => array(240, "video/mp4"), "_medium.mp4" => array(360, "video/mp4"), ".ogv" => array(null, "video/ogv"));
	$rootDir = $container->get('kernel')->getRootDir() . '/..';

	$hostUrl = "http://media.wzp.pl";
	$basePath = $this->getMediaPath($mId, $mProviderReference);

	$basePathArr = explode(".", $basePath);
	$baseExt = $basePathArr[count($basePathArr) - 1];
	unset($basePathArr[count($basePathArr) - 1]);
	$basePathWOExt = implode(".", $basePathArr);

	//Miniatura
	$miniatura = null;
	if (file_exists($rootDir . $basePathWOExt . "_miniatura.jpeg"))
	{
	    $miniatura = $basePathWOExt . "_miniatura.jpeg";
	}

	$versions = array();
	foreach ($versionTypes as $key => $w)
	{
	    if (file_exists($rootDir . $basePathWOExt . $key))
	    {
		$versions[$key] = array("type" => $w[1], "res" => $w[0], "url" => $hostUrl . $basePathWOExt . $key);
	    }
	}
	if (!file_exists($rootDir . $basePath))
	{
	    $basePath = null;
	}
	else
	{
	    $versions['base'] = array("type" => "video/mp4", "res" => 480, "url" => $hostUrl . $basePath);
	}
	$result = array("video" => $versions, "miniatura" => $miniatura, "base" => $hostUrl . $basePath);

	return $result;
    }

    private $fileTypeIcons = array(
	"file" => "fa fa-file-o fa-2x",
	"pdf" => "fa fa-file-pdf-o fa-2x",
	"excel" => "fa fa-file-excel-o fa-2x",
	"word" => "fa fa-file-word-o fa-2x",
	"archive" => "fa fa-file-archive-o fa-2x",
	"image" => "fa fa-file-image-o fa-2x",
	"text" => "fa fa-file-text-o fa-2x",
	"audio" => "fa fa-file-audio-o fa-2x",
	"video" => "fa fa-file-video-o fa-2x",
	"code" => "fa fa-file-code-o fa-2x",
	"powerpoint" => "fa fa-file-powerpoint-o fa-2x",
    );

    public function getFileIcon($mID = null, $name = null) {
	if ($mID == null && $name == null)
	{
	    $mID = $this->id;
	    $name = $this->providerReference;
	}

	$fileTypeIcons = $this->fileTypeIcons;
	$dir = (__DIR__) . "/../../../..";
	$url = $this->getMediaPath($mID, $name);
	$pathFile = $dir . $url;
	if ($mID == null || !file_exists($pathFile))
	{
	    return false;
	}
	$mimeType = mime_content_type($pathFile);
	$fileIcon = $fileTypeIcons['file'];
	if ($mimeType == "application/pdf" || $mimeType == "application/x-pdf")
	    $fileIcon = $fileTypeIcons['pdf'];
	elseif ($mimeType == "application/vnd.ms-excel" || $mimeType == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" || $mimeType == "application/vnd.ms-office")
	    $fileIcon = $fileTypeIcons['excel'];
	elseif ($mimeType == "application/rtf" || $mimeType == "text/rtf" || $mimeType == "application/msword")
	    $fileIcon = $fileTypeIcons['word'];
	elseif ($mimeType == "text/html" || $mimeType == "application/xml")
	    $fileIcon = $fileTypeIcons['code'];
	elseif ($mimeType == "application/vnd.ms-powerpoint")
	    $fileIcon = $fileTypeIcons['powerpoint'];
	elseif ($mimeType == "text/plain")
	    $fileIcon = $fileTypeIcons['text'];
	elseif (strpos($mimeType, "image") !== false)
	    $fileIcon = $fileTypeIcons['image'];

	return $fileIcon;
    }

    public function getFileIconHtml($mID = null, $name = null, $styles = null) {
	if ($mID == null && $name == null)
	{
	    $mID = $this->id;
	    $name = $this->providerReference;
	}
	else
	{
	    $this->id = $mID;
	    $this->providerReference = $name;
	}
	$fileIcon = $this->getFileIcon();

	if ($styles != null)
	{
	    $style = "style='" . $styles . "'";
	}
	else
	{
	    $style = "";
	}
	if ($fileIcon)
	{
	    $ICON = "<span class='fileIcon " . $fileIcon . "' " . $style . "></span>";
	    return $ICON;
	}
	return "Brak ikony";
    }

    public function getMediaImage($mID = null, $name = null, $width = null, $height = null) {
	if ($mID == null && $name == null)
	{
	    $mID = $this->id;
	    $name = $this->providerReference;
	}
	else
	{
	    $this->id = $mID;
	    $this->providerReference = $name;
	}
	$mediaPath = $this->getMediaPath($this->id, $this->providerReference);

	if ($mediaPath)
	{
	    $IMG = "<img src='" . $mediaPath . "' alt='" . $this->providerReference . "' style='width:" . $width . "px; height:" . $height . "'/>";
	    return $IMG;
	}
	return "Brak ikony";
    }

    public function uploadMedia($files, $container, $user = null) {
	if (!empty($files))
	{
	    $fileParts = pathinfo($files['Filedata']['name']);
	    //debug $fileParts = pathinfo('media/default/0001/01/P02K01N0001Z01MLED.jpg');

	    $targetFolder = '/../media/default/0001/01'; // Relative to the root

	    $fileref = AliasGenerator::generate($files['Filedata']['name']);
	    //debug $fileref=  AliasGenerator::generate('P02K01N0001Z01MLED');
	    $refname = $fileref . '.' . $fileParts['extension'];
	    $tempFile = $_FILES['Filedata']['tmp_name'];
	    //debug $tempFile = 'P02K01N0001Z01MLED';
	    $targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;

	    $targetFile = rtrim($targetPath, '/') . '/' . $fileref . '.' . $fileParts['extension'];

	    $fileTypes = array('jpg', 'jpeg', 'gif', 'png', 'JPG', 'JPEG', 'GIF', 'PNG'); // File extensions
	    if (in_array($fileParts['extension'], $fileTypes))
	    {
		move_uploaded_file($tempFile, $targetFile);
	    }
	    else
	    {
		echo 'ZÅ‚e rozszerzenie pliku.';
		return new Response("1");
	    }
	    $targetFileU = new UploadedFile($targetFile, $refname);

	    $obraz = new \Application\Sonata\MediaBundle\Entity\Media;
	    $obraz->setBinaryContent($targetFileU);
	    $obraz->setContext('default');
	    $obraz->setOrigNazwa($_FILES['Filedata']['name']);
	    $obraz->setProviderName('sonata.media.provider.image');
	    if ($user)
	    {
		$obraz->setAuthorName($user->getUsername());
	    }

	    //$obraz->setProviderStatus('1');
	    //$obraz->setProviderReference($fileref.$fileParts['extension']);
	    $mediaManager = $container->get('sonata.media.manager.media');
	    $mediaManager->save($obraz);
	    unlink($targetFile);
	    return $obraz;
	}
    }

    public function clearMiniatury($container, $image) {
	$pr = $container->get('sonata.media.provider.image');
//        $format = $pr->getFormatName($image, 'pano_miniaturka');
	$imagineCachePathResolver = $container->get('imagine.cache.path.resolver');

	$path2 = $pr->generatePublicUrl($image, 'reference');
	// $fullPath = $container->get('request')->getBasePath().'/'.$path;

	$yaml = new Parser();
	$ymlData = $yaml->parse(file_get_contents($container->get('kernel')->getRootDir() . '/config/config.yml'));
	$ymlData = $ymlData['avalanche_imagine'];
	$ymlData = $ymlData['filters'];

	$filters = array_keys($ymlData);


	foreach ($filters as $filterName)
	{
	    $filePath = urldecode(urldecode($imagineCachePathResolver->getBrowserPath($path2, $filterName)));

	    $filePath = str_replace('app_dev.php', '', $filePath);
	    $filePath = str_replace('app.php', '', $filePath);
	    $filePath = ltrim($filePath, '/');

//                 echo $container->get('kernel')->getRootDir().'/../web/'.$filePath.'<br>';
//                echo $container->get('kernel')->getRootDir() . '/../web/' . $filePath."<br>";

	    if (file_exists($container->get('kernel')->getRootDir() . '/../web/' . $filePath))
	    {
		unlink($container->get('kernel')->getRootDir() . '/../web/' . $filePath);
	    }
	}
    }

    //$p=>pathToCreate, $b=>pathBaseFile, $time=>frame time, $token=>secure token [id.providerReference.createdAt[Y-m-d]]
    public function createThumbnailMovie($id = 0, $p, $b, $time, $token, $media = null) {
	if ($media && !$token)
	{
	    $token = $media->getId() . $media->getProviderReference() . $media->getCreatedAt->format("Y-m-d");
	}
	$ch = curl_init();
	$url = 'http://media.wzp.pl/media/createThumbnail.php?id=' . $id . '&p=' . $p . '&b=' . $b . '&time=' . $time . '&t=' . $token;
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$result = curl_exec($ch);

	return $result;
    }

}
