<?php
/**
 * 演算法題庫 - 找出重複元素 (大量資料)
 * ----------------------------------------------------
 * 題目說明：給定一個包含 N+1 個整數的陣列，數字範圍在 1 到 N 之間，找出重複的那個數。要求 O(N) 時間複雜度。
 * 難度：中等/困難 (取決於 O(N) 和 O(1) 空間限制)
 */

// ** 解法思路 (Markdown 格式) **
/*
# 解法思路 (O(N) 時間, O(1) 空間，Floyd's Tortoise and Hare)
1.  **關鍵資料結構/演算法**: 快慢指標 (Floyd's Tortoise and Hare - 應用於鏈表循環檢測)
2.  **步驟**:
    -   將陣列視為一個鏈表：索引 i 的下一個元素是 nums[i]。因為有重複，所以一定存在一個循環。
    -   **階段一 (找到相遇點)**：使用快慢指標 (slow = nums[slow], fast = nums[nums[fast]])，它們最終會在循環內相遇。
    -   **階段二 (找到循環起點)**：將慢指標 reset 回 0，快指標保持在相遇點。兩者以相同速度 (一步一步) 向前移動，它們再次相遇的位置就是重複的數字。
3.  **PHP 特性應用**: 數組索引間接訪問模擬鏈表。
*/

class Solution {
    public function findDuplicate(array $nums): int {
        // 1. 找到相遇點 (Cycle Detection)
        $slow = $nums[0];
        $fast = $nums[$nums[0]];

        while ($slow !== $fast) {
            $slow = $nums[$slow];
            $fast = $nums[$nums[$fast]];
        }

        // 2. 找到循環起點 (即重複數字)
        $ptr1 = $nums[0];
        $ptr2 = $slow;

        while ($ptr1 !== $ptr2) {
            $ptr1 = $nums[$ptr1];
            $ptr2 = $nums[$ptr2];
        }

        return $ptr1;
    }
    public function solve($nums) { return $this->findDuplicate($nums); }
}

// ** 複雜度分析 **
/*
 * 時間複雜度 (Time Complexity): O(N)。
 * 空間複雜度 (Space Complexity): O(1)。
 */
