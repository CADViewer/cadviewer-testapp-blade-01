<?php
// CADViewer PHP handler configuration for the Laravel Blade sample.
//
// The handlers in public/php (git submodule CADViewer/cadviewer-php-scripts) ship a generic
// CADViewer_config.php that expects an install under a ".../cadviewer/" folder and URL.
// This file replaces it: copy it to public/php/CADViewer_config.php
// ("composer run cadviewer:setup" locally, done automatically in the Docker image).
//
// Every location can be overridden with an environment variable:
//   CADVIEWER_BASE_URL        public URL of the Laravel public/ folder (default: derived from the request)
//   CADVIEWER_HOME_DIR        path of the Laravel public/ folder         (default: parent of this file)
//   CADVIEWER_CONVERTERS_DIR  path of the converters folder              (default: <project>/converters)
//   CADVIEWER_DEBUG           "true" / "false"                           (default: true)

$env_path = function ($name, $default) {
	$value = getenv($name);
	return rtrim($value !== false && $value !== '' ? $value : $default, '/\\') . '/';
};

// $home_dir: folder containing content/, converters/files/ and php/ (the Laravel public/ folder)
$home_dir = $env_path('CADVIEWER_HOME_DIR', dirname(__DIR__));
$home_dir_app = $home_dir;

// $httpHost: URL matching $home_dir. Behind a reverse proxy (Coolify/Traefik) the request reaches
// PHP over plain http, so the forwarded headers are used to rebuild the public https URL.
$base_url = getenv('CADVIEWER_BASE_URL');
if ($base_url === false || $base_url === '') {
	$scheme = $_SERVER['HTTP_X_FORWARDED_PROTO'] ?? ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http');
	$host = $_SERVER['HTTP_X_FORWARDED_HOST'] ?? $_SERVER['HTTP_HOST'] ?? 'localhost';
	$base_url = explode(',', $scheme)[0] . '://' . explode(',', $host)[0];
}
$httpHost = rtrim($base_url, '/') . '/';

// Converter binaries, licenses and fonts live outside the web root
$converters_dir = $env_path('CADVIEWER_CONVERTERS_DIR', dirname(__DIR__, 2) . '/converters');

$platform = "notset";
$ax2026_executable = "notset";

if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
	$platform = "windows";
	$ax2026_executable = "AX2026_W64_27_07_163d.exe";
	$dwgmerge2026_executable = "DwgMerge2023_W32_23_01_01.exe";
	$linklist2026_executable = "LinkList_2025_W64_25_07_14.exe";
} else {
	$platform = "linux";
	$ax2026_executable = "ax2026_L64_27_06b_163d";
	$dwgmerge2026_executable = "DwgMerge_2023_L64_23_12_03";
	$linklist2026_executable = "LinkList_2025_L64_25_07_14";
}

// Older variable names still read by make_singlepage_pdf.php, merge-dwg-file.php and return-path.php
$ax2023_executable = $ax2026_executable;
$dwgmerge2020_executable = $dwgmerge2026_executable;
$linklist2023_executable = $linklist2026_executable;

$svgz_compress = true;
$cached_conversion = false;

$checkorigin = false;
$allowed_domains = array(
	'http://localhost:8080',
	'http://localhost',
	'*'
);

$jsonp_flag = false;

$httpPhpUrl = $httpHost . "php/";

$fileLocation = $home_dir . "converters/files/";
$fileLocationUrl = $httpHost . "converters/files/";
$xpathLocation = $home_dir . "converters/files/";

$converterLocation = $converters_dir . "autoxchange/" . $platform . "/";
$dwgmergeLocation = $converters_dir . "dwgmerge/" . $platform . "/";
$linklistLocation = $converters_dir . "linklist/" . $platform . "/";
$licenseLocation = $converters_dir . "autoxchange/" . $platform . "/";
$fontLocation = $converters_dir . "autoxchange/fonts/";

$community_executable = "dwg2SVG.exe";

$callbackMethod = "getFile_09.php";

$debug = filter_var(getenv('CADVIEWER_DEBUG') === false ? 'true' : getenv('CADVIEWER_DEBUG'), FILTER_VALIDATE_BOOLEAN);

$windowsbatprocessing = false;

// PDF to SVG / SVG to PDF java tooling (not shipped with this sample)
$javaFolder = "C:\\jdk1.8.0_121";
$pdfConverterFolder = $converters_dir . "pdf_converter";
$pdfBatchExecutable = "run_pdftosvgmainclass";
$pdfGetPagesExecutable = "run_pdftosvg_pages";
$batikFolder = $converters_dir . "pdf_converter/batik-1.9";
$batikVersion = "1.9";
$pdfboxFolder = $converters_dir . "pdf_converter/pdfbox";
$pdfboxVersion = "1.8.13";
$svg2pdfExecutable = "run_svg2pdf";
$svg2pdfJavaHeap = "-Xmx1024m";
$pdfSplitExecutable = "run_splitpdf";
$pdfsMergeExecutable = "run_mergepdfs";
$pdfboxVersionSplitMerge = "2.0.9";
?>
