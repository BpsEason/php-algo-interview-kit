<?php
/**
 * 演算法題庫 - 找出最長不重複子字串
 * ----------------------------------------------------
 * 題目說明：找出給定字串中最長不重複字元的子字串的長度。
 * 難度：中等
 */

// ** 解法思路 (Markdown 格式) **
/*
# 解法思路
1.  **關鍵資料結構/演算法**: 滑動窗口 (Sliding Window) + HashMap
2.  **步驟**:
    -   使用 $left 指標作為窗口左邊界，$right 指標遍歷字串。
    -   使用 $charMap 存儲字符及其最後出現的索引。
    -   如果當前字符 $s[$right] 已經在 $charMap 中且其索引大於 $left，則將 $left 移到 $charMap[$s[$right]] + 1。
    -   更新 $charMap[$s[$right]] = $right。
    -   更新 $maxLength = max($maxLength, $right - $left + 1)。
3.  **PHP 特性應用**: 陣列 (HashMap) 實現快速查找。
*/

class Solution {
    public function lengthOfLongestSubstring(string $s): int {
        $n = strlen($s);
        $maxLength = 0;
        $left = 0;
        $charMap = [];

        for ($right = 0; $right < $n; $right++) {
            $char = $s[$right];
            if (isset($charMap[$char]) && $charMap[$char] >= $left) {
                // 發現重複字符，移動左邊界
                $left = $charMap[$char] + 1;
            }
            // 更新字符的最新索引
            $charMap[$char] = $right;
            // 更新最大長度
            $maxLength = max($maxLength, $right - $left + 1);
        }
        return $maxLength;
    }
}

// ** 複雜度分析 **
/*
 * 時間複雜度 (Time Complexity): O(N)，因為每個字符 $s[$i] 只會被 $right 和 $left 遍歷一次。
 * 空間複雜度 (Space Complexity): O(K)，K 是字符集大小 (例如 ASCII 碼為 256)。
 */
