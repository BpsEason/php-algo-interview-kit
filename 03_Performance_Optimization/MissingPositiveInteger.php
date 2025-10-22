<?php
/**
 * 演算法題庫 - 找出陣列中缺失的最小正整數
 * ----------------------------------------------------
 * 題目說明：給定一個未排序的整數陣列，找出其中缺失的最小正整數。要求 O(N) 時間複雜度和 O(1) 空間複雜度。
 * 難度：困難
 */

// ** 解法思路 (Markdown 格式) **
/*
# 解法思路
1.  **關鍵資料結構/演算法**: In-place Hashing (原地雜湊/桶排序思維)
2.  **步驟**:
    -   核心思想：將 1 放在索引 0，將 2 放在索引 1，以此類推。
    -   第一次遍歷：遍歷陣列，如果 nums[i] 滿足 1 <= nums[i] <= N 且 nums[i] != nums[nums[i]-1]，則交換 nums[i] 和 nums[nums[i]-1]，直到元素被放在正確的位置或不滿足條件。
    -   第二次遍歷：遍歷陣列，如果 nums[i] 不等於 i + 1，則 i + 1 就是缺失的最小正整數。
    -   如果都匹配，則缺失的最小正整數是 N + 1。
3.  **PHP 特性應用**: 數組傳引用和元素交換實現 O(1) 空間操作。
*/

class Solution {
    public function firstMissingPositive(array $nums): int {
        $n = count($nums);
        
        // 1. In-place Hashing
        for ($i = 0; $i < $n; $i++) {
            // 條件：1 <= nums[i] <= N 且 nums[i] 不在正確的位置
            while ($nums[$i] > 0 && $nums[$i] <= $n && $nums[$nums[$i] - 1] != $nums[$i]) {
                $targetIndex = $nums[$i] - 1;
                // 交換
                $temp = $nums[$targetIndex];
                $nums[$targetIndex] = $nums[$i];
                $nums[$i] = $temp;
            }
        }

        // 2. 找到第一個不匹配的
        for ($i = 0; $i < $n; $i++) {
            if ($nums[$i] !== $i + 1) {
                return $i + 1;
            }
        }

        // 3. 都匹配，返回 N + 1
        return $n + 1;
    }
    public function solve($nums) { return $this->firstMissingPositive($nums); }
}

// ** 複雜度分析 **
/*
 * 時間複雜度 (Time Complexity): O(N)。雖然有嵌套循環，但每個元素最多被交換兩次，總操作次數是線性的。
 * 空間複雜度 (Space Complexity): O(1) (In-place)。
 */
