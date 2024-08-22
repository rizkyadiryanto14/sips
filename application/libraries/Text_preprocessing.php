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

        // Stopwords sederhana (Anda bisa memperluas daftar ini)
        $stopwords = ['pada', 'dan', 'yang', 'di', 'ke', 'dari', 'berbasis'];

        // Hapus stopwords
        $tokens = array_diff($tokens, $stopwords);

        // Stemming (Contoh sederhana, biasanya menggunakan library khusus)
        // Misal, ubah "implementasi" menjadi "implement"
        // Catatan: Anda bisa menggunakan library seperti Sastrawi untuk stemming di bahasa Indonesia

        return $tokens;
    }

    // Fungsi untuk menghitung kemiripan menggunakan TF-IDF
    public function calculate_tfidf_similarity($input_tokens, $doc_tokens) {
        $all_tokens = array_unique(array_merge($input_tokens, $doc_tokens));
        $input_vector = $this->tfidf_vectorize($input_tokens, $all_tokens);
        $doc_vector = $this->tfidf_vectorize($doc_tokens, $all_tokens);

        return $this->cosine_similarity($input_vector, $doc_vector);
    }

    // Membuat vektor TF-IDF
    private function tfidf_vectorize($tokens, $all_tokens) {
        $vector = [];
        foreach ($all_tokens as $token) {
            $tf = $this->term_frequency($token, $tokens);
            $idf = 1; // IDF sederhana untuk dokumen tunggal
            $vector[] = $tf * $idf;
        }
        return $vector;
    }

    // Menghitung term frequency (TF)
    private function term_frequency($term, $tokens) {
        $count = array_count_values($tokens);
        return isset($count[$term]) ? $count[$term] / count($tokens) : 0;
    }

    // Menghitung cosine similarity
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
