<?php
/**
 * 演算法題庫 - 找出第一個不重複字元
 * ----------------------------------------------------
 * 題目說明：找出字串中第一個不重複出現的字元的索引，如果不存在則返回 -1。
 * 難度：簡單
 */

// ** 解法思路 (Markdown 格式) **
/*
# 解法思路
1.  **關鍵資料結構/演算法**: 兩次遍歷 + HashMap (頻率統計)
2.  **步驟**:
    -   第一次遍歷：使用 HashMap (PHP 陣列) 統計每個字符的出現次數。
    -   第二次遍歷：遍歷字串，檢查當前字符的計數是否為 1。
    -   如果計數為 1，則返回當前索引。
    -   如果遍歷結束仍未找到，返回 -1。
3.  **PHP 特性應用**: 再次利用 array_count_values 提高統計效率。
*/

class Solution {
    public function firstUniqChar(string $s): int {
        // 第一次遍歷：統計頻率
        $counts = array_count_values(str_split($s));

        // 第二次遍歷：找出第一個計數為 1 的字符
        for ($i = 0; $i < strlen($s); $i++) {
            if ($counts[$s[$i]] === 1) {
                return $i;
            }
        }
        return -1;
    }
    public function solve($s) { return $this->firstUniqChar($s); }
}

// ** 複雜度分析 **
/*
 * 時間複雜度 (Time Complexity): O(N)，兩次遍歷字串。
 * 空間複雜度 (Space Complexity): O(K)，K 是字符集大小。
 */
