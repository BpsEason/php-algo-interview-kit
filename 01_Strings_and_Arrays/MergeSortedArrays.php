<?php
/**
 * 演算法題庫 - 合併兩個已排序陣列
 * ----------------------------------------------------
 * 題目說明：將 nums2 合併到 nums1 中，使 nums1 成為一個已排序的陣列 (in-place)。
 * 難度：中等
 */

// ** 解法思路 (Markdown 格式) **
/*
# 解法思路
1.  **關鍵資料結構/演算法**: 雙指標 (Two Pointers)，從尾部開始。
2.  **步驟**:
    -   設定 p1 指向 nums1 有效尾部 (m-1)，p2 指向 nums2 尾部 (n-1)，p_write 指向 nums1 寫入尾部 (m+n-1)。
    -   當 p2 >= 0 時，進行循環：比較 nums1[p1] 和 nums2[p2]，將較大者寫入 nums1[p_write]，並移動對應指標。
    -   從尾部寫入可避免覆蓋 nums1 中尚未處理的元素。
3.  **PHP 特性應用**: 使用引用 & 傳遞 $nums1 實現 in-place 修改。
*/

class Solution {
    public function merge(array &$nums1, int $m, array $nums2, int $n): void {
        $p1 = $m - 1;
        $p2 = $n - 1;
        $p_write = $m + $n - 1;

        while ($p2 >= 0) {
            if ($p1 >= 0 && $nums1[$p1] > $nums2[$p2]) {
                $nums1[$p_write] = $nums1[$p1];
                $p1--;
            } else {
                $nums1[$p_write] = $nums2[$p2];
                $p2--;
            }
            $p_write--;
        }
    }
    // 為了配合模板，封裝 solve 函式
    public function solve($input) {
        list($nums1, $m, $nums2, $n) = $input;
        $this->merge($nums1, $m, $nums2, $n);
        return $nums1;
    }
}

// ** 複雜度分析 **
/*
 * 時間複雜度 (Time Complexity): O(m + n)。
 * 空間複雜度 (Space Complexity): O(1) (In-place)。
 */
