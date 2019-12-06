<?php
echo "
<html>
<head> 
<title>Encode Decode - Kaito Legion</title>
</head>
<style>
body {
	text-align:center;
}
h1 {
	font-family: courier new;
}
textarea {
	width:390px;
	height:100px;
}
</style>
<body>
<h1>Encode - Decode</h1>

<form method=\"POST\">
<textarea name=\"code\">
</textarea>
<br>
<select name='ende'>
        <option value=\"urlencode\">Select</option>
        <option value=\"base64\">Base64</option>
        <option value=\"base64convert\">base64 - convert_uu</option>
        <option value=\"gzinflates\">gzinflate - base64</option>
        <option value=\"str2\">str_rot13 - base64</option>
        <option value=\"gzinflate\">str_rot13 - gzinflate - base64</option>
        <option value=\"str\">str_rot13 - gzinflate - str_rot13 - base64</option>
        <option value=\"url\">base64 - gzinflate - str_rot13 - convert_uu - gzinflate - base64</option>
</select>
<br>
<input type='submit' name='encode' value='Encode'>
<input type='submit' name='decode' value='Decode'>
<br>
";

@ini_set('output_buffering',0); 
@ini_set('display_errors', 0);
$text = $_POST['code'];
$encode = $_POST['encode'];
if (isset($encode)) {
	$ende = $_POST['ende'];

switch ($ende) {
	case 'urlencode':
		$kai = rawurlencode($text);
		break;
	case 'base64':
		$kai = base64_encode($text);
		$kai = "<?php eval('?>'.base64_decode('$kai'));";
		break;
	case 'base64convert':
		$kai = base64_encode(convert_uuencode($text));
		break;
	case 'gzinflates':
		$kai = base64_encode(gzdeflate($text));
		break;
	case 'str2':
		$kai = base64_encode(str_rot13($text));
		break;
	case 'gzinflate':
		$kai = base64_encode(gzdeflate(str_rot13($text)));
		break;
	case 'str':
		$kai = base64_encode(str_rot13(gzdeflate(str_rot13($text))));
		break;
	case 'url':
		$kai = base64_encode(gzdeflate(convert_uuencode(str_rot13(gzdeflate(base64_encode($text))))));
		break;

	default:
		# code...
		break;
    }
}

$decode = $_POST['decode'];
if (isset($decode)) {
	$ende = $_POST['ende'];
switch ($ende) {
	case 'urlencode':
		$kai = rawurldecode($text);
		break;
	case 'base64':
		$kai = base64_decode($text);
		break;
	case 'base64convert':
		$kai = convert_uudecode(base64_decode($text));
		break;
	case 'gzinflates':
		$kai = gzinflate(base64_decode($text));
		break;
	case 'str2':
		$kai = str_rot13(base64_decode($text));
		break;
	case 'gzinflate':
		$kai = str_rot13(gzinflate(base64_decode($text)));
		break;
	case 'str':
		$kai = str_rot13(gzinflate(str_rot13(base64_decode(($text)))));
		break;
	case 'url':
		$kai = base64_decode(gzinflate(str_rot13(convert_uudecode(gzinflate(base64_decode(($text)))))));
		break;
	default:
		# code...
		break;


    }
}

echo "

<textarea>
$kai
</textarea>


</form>
</body>
</html>

";


?>
