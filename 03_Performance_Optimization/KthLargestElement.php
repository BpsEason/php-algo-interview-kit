<?php
/**
 * 演算法題庫 - 找出陣列中第 K 大元素
 * ----------------------------------------------------
 * 題目說明：在未排序的陣列中找到第 K 個最大的元素。
 * 難度：中等/困難
 */

// ** 解法思路 (Markdown 格式) **
/*
# 解法思路 (使用 SplPriorityQueue 最小堆)
1.  **關鍵資料結構/演算法**: 最小堆 (Min-Heap / 優先佇列)
2.  **步驟**:
    -   創建一個大小為 K 的最小堆。
    -   遍歷陣列：
        -   將前 K 個元素無條件推入堆中。
        -   從第 K+1 個元素開始，如果當前元素大於堆頂元素 (即堆中最小元素)，則彈出堆頂元素，並推入當前元素。
    -   遍歷結束後，堆頂元素就是第 K 大元素。
3.  **PHP 特性應用**: SplPriorityQueue 實現高效的堆結構。
*/

class Solution {
    public function findKthLargest(array $nums, int $k): int {
        $minHeap = new SplPriorityQueue();
        $minHeap->setExtractFlags(SplPriorityQueue::EXTR_DATA);

        foreach ($nums as $num) {
            if ($minHeap->count() < $k) {
                // PHP 的 SplPriorityQueue 默認為最大堆，需要使用負數來模擬最小堆
                $minHeap->insert($num, -$num);
            } elseif ($num > $minHeap->top()) {
                $minHeap->extract();
                $minHeap->insert($num, -$num);
            }
        }
        return $minHeap->top();
    }
    public function solve($input) {
        list($nums, $k) = $input;
        return $this->findKthLargest($nums, $k);
    }
}

// ** 複雜度分析 **
/*
 * 時間複雜度 (Time Complexity): O(N log K)，N 次操作，每次操作 log K (堆操作)。
 * 空間複雜度 (Space Complexity): O(K)，堆的大小。
 */
