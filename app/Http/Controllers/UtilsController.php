<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UtilsController extends Controller
{
    private $blacklist;
    private $emojis;

    public function __construct()
    {
        $this->blacklist = config('blacklist');
        $this->emojis = config('emojis');
    }

    public function generateRandomCode($length) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $code = '';
        
        for ($i = 0; $i < $length; $i++) {
            $code .= $characters[rand(0, strlen($characters) - 1)];
        }
        
        return $code;
    }

    public function censorText(string $text): string {
        foreach ($this->blacklist as $word) {
            $pattern = '/\b' . preg_quote($word, '/') . '\b/i';
            $replacement = substr($word, 0, 1) . str_repeat('*', strlen($word) - 1);
            $text = preg_replace($pattern, $replacement, $text);
        }
        return $text;
    }

    function hasOffensiveWords(string $text, array $blacklist): bool {
        foreach ($blacklist as $word) {
            $pattern = '/\b' . preg_quote($word, '/') . '\b/i';
            if (preg_match($pattern, $text)) {
                return true;
            }
        }
        return false;
    }

    public function clearText(string $text): string {
    
    if (!empty($text)) {
        $padraoLink = '/(https?:\/\/[^\s]+)/i';
        $padraoTagUser = '/(?:\s|^)(@[a-zA-Z0-9_]+)/';
        $padraoHashtag = '/(?<!\S)(#[\wÀ-ÿ]+)/u';

        // Escapar o texto antes de inserir HTML
        $text = htmlspecialchars($text, ENT_QUOTES, 'UTF-8');

        // Links
        $text = preg_replace_callback($padraoLink, function ($matches) {
            $url = $matches[0];
            // Aqui o link já está escapado, então decodificamos para deixar o href limpo
            $url = htmlspecialchars_decode($url);
            return "<a href='{$url}' target='_blank' style='word-wrap: break-word;'>{$url}</a>";
        }, $text);

        // Menções
        $text = preg_replace_callback($padraoTagUser, function ($matches) {
            $username = ltrim(trim($matches[1]), '@');
            return " <a href='/@{$username}' style='word-wrap: break-word;'>{$matches[1]}</a>";
        }, $text);

        // Hashtags
        $text = preg_replace_callback($padraoHashtag, function ($matches) {
            $hashtag = ltrim($matches[1], '#');
            return "<a href='/post/hashtag/{$hashtag}' style='word-wrap: break-word;'>{$matches[1]}</a>";
        }, $text);

        // Não aplicar nl2br aqui — faça isso na view!

        return $this->replaceEmojis($text);
    }

    return $text;
}

    function escapeHtml($text) {
        return htmlspecialchars($text, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }

    function replaceEmojis($text) {
        return str_replace(array_keys($this->emojis), array_values($this->emojis), $text);
    }




}
