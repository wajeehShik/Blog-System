<?php

namespace App\Http\Helpers;

class EditorArabic
{

    public static function editorContent($content)
    {

        $dom = new \DomDocument();
        $dom->encoding = 'utf-8';
        $dom->loadHtml(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $dom->encoding = 'utf-8';
        $imageFile = $dom->getElementsByTagName('img');

        foreach ($imageFile as $item => $image) {
            $data = $image->getAttribute('src');
            if (strpos($data, 'data') !== false) {
                list($type, $data) = array_pad(explode(';', $data), 2, null);
                list(, $data) = array_pad(explode(',', $data), 2, null);
                $dataConvert = base64_decode($data);
                $image_name = "/upload/wasfas/" . time() . $item . '.png';
                $path = public_path() . $image_name;

                file_put_contents($path, $dataConvert);

                $image->removeAttribute('src');
                $image->setAttribute('src', $image_name);
            }
        }


        $content =  $dom->saveHTML();

        return $content;
    }
}
