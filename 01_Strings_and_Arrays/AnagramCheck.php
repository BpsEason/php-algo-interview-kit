<?php
/**
 * 演算法題庫 - 判斷兩字串是否為異位詞 (Anagram)
 * ----------------------------------------------------
 * 題目說明：判斷字串 t 是否是字串 s 的異位詞 (Anagram)。
 * 難度：簡單
 */

// ** 解法思路 (Markdown 格式) **
/*
# 解法思路
1.  **關鍵資料結構/演算法**: HashMap (頻率統計)
2.  **步驟**:
    -   檢查兩字串長度是否相等。
    -   使用 count_chars(s, 1) 和 count_chars(t, 1) 統計兩字串的字元頻率。
    -   比較兩個頻率陣列是否完全相等。
3.  **PHP 特性應用**: 使用 count_chars 函式，這是 PHP C 層級實現，性能極高。
*/

class Solution {
    public function isAnagram(string $s, string $t): bool {
        if (strlen($s) !== strlen($t)) return false;
        return count_chars($s, 1) === count_chars($t, 1);
    }
}

// 測試案例
// $solution = new Solution();
// var_dump($solution->isAnagram("anagram", "nagaram")); // true

// ** 複雜度分析 **
/*
 * 時間複雜度 (Time Complexity): O(N)，N為字串長度。
 * 空間複雜度 (Space Complexity): O(1)，因為字元集大小固定。
 */
