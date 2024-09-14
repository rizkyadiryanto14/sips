<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Text_preprocessing {

    // Fungsi untuk melakukan tokenisasi dan normalisasi teks
    public function process($text) {
        // Ubah ke huruf kecil
        $text = strtolower($text);

        // Hapus tanda baca
        $text = preg_replace('/[^\w\s]/', '', $text);

        // Tokenisasi
        $tokens = explode(' ', $text);

        $stopwords = ['pada', 'dan', 'yang', 'di', 'ke', 'dari', 'berbasis'];

        $tokens = array_diff($tokens, $stopwords);


        return $tokens;
    }

    public function calculate_tfidf_similarity($input_tokens, $doc_tokens) {
        $all_tokens = array_unique(array_merge($input_tokens, $doc_tokens));
        $input_vector = $this->tfidf_vectorize($input_tokens, $all_tokens);
        $doc_vector = $this->tfidf_vectorize($doc_tokens, $all_tokens);

        return $this->cosine_similarity($input_vector, $doc_vector);
    }

    private function tfidf_vectorize($tokens, $all_tokens) {
        $vector = [];
        foreach ($all_tokens as $token) {
            $tf = $this->term_frequency($token, $tokens);
            $idf = 1;
            $vector[] = $tf * $idf;
        }
        return $vector;
    }

    private function term_frequency($term, $tokens) {
        $count = array_count_values($tokens);
        return isset($count[$term]) ? $count[$term] / count($tokens) : 0;
    }

    private function cosine_similarity($vec1, $vec2) {
        $dot_product = 0;
        $vec1_magnitude = 0;
        $vec2_magnitude = 0;

        for ($i = 0; $i < count($vec1); $i++) {
            $dot_product += $vec1[$i] * $vec2[$i];
            $vec1_magnitude += pow($vec1[$i], 2);
            $vec2_magnitude += pow($vec2[$i], 2);
        }

        $vec1_magnitude = sqrt($vec1_magnitude);
        $vec2_magnitude = sqrt($vec2_magnitude);

        if ($vec1_magnitude * $vec2_magnitude == 0) {
            return 0;
        } else {
            return $dot_product / ($vec1_magnitude * $vec2_magnitude);
        }
    }
}
