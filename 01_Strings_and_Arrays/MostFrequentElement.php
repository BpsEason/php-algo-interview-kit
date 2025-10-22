<?php
/**
 * 演算法題庫 - 陣列中出現次數最多的元素
 * ----------------------------------------------------
 * 題目說明：找出給定陣列中出現次數最多的那個元素。
 * 難度：簡單
 */

// ** 解法思路 (Markdown 格式) **
/*
# 解法思路
1.  **關鍵資料結構/演算法**: HashMap (頻率統計)
2.  **步驟**:
    -   使用 array_count_values 函式統計陣列中所有元素的出現次數。
    -   使用 arsort 函式對統計結果按值 (次數) 進行降序排序。
    -   返回排序後陣列的第一個鍵 (即出現次數最多的元素)。
3.  **PHP 特性應用**: 充分利用 array_count_values 和 arsort 實現高效的統計和排序。
*/

class Solution {
    public function mostFrequentElement(array $nums): int {
        if (empty($nums)) return 0; // 處理空陣列

        // 1. 統計頻率
        $counts = array_count_values($nums);

        // 2. 按值降序排序 (次數最多在前)
        arsort($counts);

        // 3. 返回第一個鍵 (元素本身)
        reset($counts);
        return key($counts);
    }
}

// ** 複雜度分析 **
/*
 * 時間複雜度 (Time Complexity): O(N + C log C)，N是陣列大小，C是唯一元素的數量。主要耗時在統計和排序。
 * 空間複雜度 (Space Complexity): O(C)，用於存儲計數陣列。
 */
