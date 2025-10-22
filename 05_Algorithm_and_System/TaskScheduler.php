<?php
/**
 * 演算法題庫 - 模擬分散式任務排程器 (冷卻時間間隔)
 * ----------------------------------------------------
 * 題目說明：給定一系列任務 (字符) 和一個冷卻時間 n，計算執行所有任務所需的最少時間間隔。
 * 難度：中等/困難
 */

// ** 解法思路 (Markdown 格式) **
/*
# 解法思路 (貪婪算法)
1.  **關鍵資料結構/演算法**: 貪婪算法 + 頻率統計
2.  **步驟**:
    -   統計每個任務的出現頻率 $maxFreq$ (最高頻率)。
    -   最少時間間隔的下限是：(最高頻率 - 1) * (冷卻時間 + 1) + 頻率為 $maxFreq$ 的任務個數 $maxCount$。
    -   這是因為 $maxFreq - 1$ 組任務需要 $n$ 個空閒時間，最後一組不需要。
    -   結果是：$max(總任務數, (maxFreq - 1) * (n + 1) + maxCount)$。
3.  **PHP 特性應用**: 陣列頻率統計。
*/

class Solution {
    public function leastInterval(array $tasks, int $n): int {
        // 1. 統計頻率
        $counts = array_count_values($tasks);
        
        // 2. 找出最高頻率
        $maxFreq = 0;
        foreach ($counts as $count) {
            $maxFreq = max($maxFreq, $count);
        }

        // 3. 找出具有最高頻率的任務個數
        $maxCount = 0;
        foreach ($counts as $count) {
            if ($count === $maxFreq) {
                $maxCount++;
            }
        }

        // 4. 計算所需時間下限 (排滿最高頻率任務所需的空間)
        $timeSlots = ($maxFreq - 1) * ($n + 1) + $maxCount;

        // 5. 結果是總任務數和下限中的較大值
        return max(count($tasks), $timeSlots);
    }
    public function solve($input) {
        list($tasks, $n) = $input;
        return $this->leastInterval($tasks, $n);
    }
}

// ** 複雜度分析 **
/*
 * 時間複雜度 (Time Complexity): O(N + K)，N 是任務總數，K 是任務種類數 (定值 26)。
 * 空間複雜度 (Space Complexity): O(K)，用於存儲計數陣列。
 */
