<?php
/**
 * 演算法題庫 - 判斷一個數是否為質數
 * ----------------------------------------------------
 * 題目說明：判斷給定整數是否為質數，並進行效能優化。
 * 難度：簡單/中等
 */

// ** 解法思路 (Markdown 格式) **
/*
# 解法思路
1.  **關鍵資料結構/演算法**: 數學優化 (只除到 sqrt(N))
2.  **步驟**:
    -   處理特殊情況 1, 2, 3。
    -   檢查 2 和 3 的倍數。
    -   循環檢查：只需檢查從 5 開始的 6k +/- 1 形式的數，直到 $i <= sqrt(n)$。
3.  **PHP 特性應用**: 使用 sqrt 函式進行時間優化。
*/

class Solution {
    public function isPrime(int $n): bool {
        if ($n <= 1) return false;
        if ($n <= 3) return true;
        if ($n % 2 == 0 || $n % 3 == 0) return false;

        $limit = (int)sqrt($n);

        for ($i = 5; $i <= $limit; $i += 6) {
            if ($n % $i == 0 || $n % ($i + 2) == 0) {
                return false;
            }
        }
        return true;
    }
    public function solve($n) { return $this->isPrime($n); }
}

// ** 複雜度分析 **
/*
 * 時間複雜度 (Time Complexity): O(sqrt(N))。
 * 空間複雜度 (Space Complexity): O(1)。
 */
