<?php
/**
 * 演算法題庫 - 陣列中兩數之和為目標值
 * ----------------------------------------------------
 * 題目說明：找出陣列中哪兩個數相加等於目標值，並返回它們的索引。
 * 難度：簡單
 */

// ** 解法思路 (Markdown 格式) **
/*
# 解法思路
1.  **關鍵資料結構/演算法**: HashMap (空間換時間)
2.  **步驟**:
    -   遍歷陣列 $nums，對於當前數字 $num 和其索引 $i。
    -   計算需要的差值 $diff = $target - $num。
    -   檢查 HashMap ($map) 中是否已經存儲了 $diff。
    -   如果存在，則返回 $map[$diff] 和 $i。
    -   如果不存在，將當前數字 $num 及其索引 $i 存入 $map。
3.  **PHP 特性應用**: 利用 PHP 陣列作為高效的 HashMap，實現 O(1) 查找。
*/

class Solution {
    public function twoSum(array $nums, int $target): array {
        $map = [];
        foreach ($nums as $i => $num) {
            $diff = $target - $num;
            if (isset($map[$diff])) {
                return [$map[$diff], $i];
            }
            $map[$num] = $i;
        }
        return [];
    }
    public function solve($input) {
        list($nums, $target) = $input;
        return $this->twoSum($nums, $target);
    }
}

// ** 複雜度分析 **
/*
 * 時間複雜度 (Time Complexity): O(N)，只遍歷了一次陣列。
 * 空間複雜度 (Space Complexity): O(N)，用於存儲 HashMap。
 */
