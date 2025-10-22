<?php
/**
 * 演算法題庫 - 設計一個 API Rate Limiter
 * ----------------------------------------------------
 * 題目說明：實現一個基於時間窗口計數 (Fixed Window Counter) 的限流器。
 * 難度：中等/困難 (實戰設計題)
 */

// ** 解法思路 (Markdown 格式) **
/*
# 解法思路 (固定窗口計數)
1.  **關鍵資料結構/演算法**: HashMap + 時間戳記
2.  **步驟**:
    -   定義 $limit (限制次數) 和 $window (時間窗口，例如 60 秒)。
    -   使用 HashMap ($requests) 存儲每個使用者 (或 IP) 在當前時間窗口內的請求次數。
    -   **Request**: 獲取當前時間窗口 $currentWindow = floor(time() / $window)。
    -   如果 $currentWindow != $requests['window']，表示進入新窗口，重置計數 $requests = ['window' => $currentWindow, 'count' => 1]。
    -   如果 $requests['count'] < $limit，則 $requests['count']++ 並允許請求。
    -   否則，拒絕請求 (限流)。
3.  **PHP 特性應用**: 模擬設計，使用時間函數 time() 和陣列模擬分佈式快取 (例如 Redis)。
*/

class RateLimiter {
    private $limit; // 限制次數
    private $window; // 時間窗口 (秒)
    private $requests = []; // 模擬 Redis/Cache: key => ['window' => int, 'count' => int]

    public function __construct(int $limit, int $window) {
        $this->limit = $limit;
        $this->window = $window;
    }

    public function allowRequest(string $userId): bool {
        $currentTime = time();
        $currentWindow = (int)floor($currentTime / $this->window);

        if (!isset($this->requests[$userId])) {
            $this->requests[$userId] = ['window' => $currentWindow, 'count' => 0];
        }

        $userReq = &$this->requests[$userId];

        if ($userReq['window'] !== $currentWindow) {
            // 進入新窗口，重置
            $userReq['window'] = $currentWindow;
            $userReq['count'] = 1;
            return true;
        }

        if ($userReq['count'] < $this->limit) {
            // 仍在限制內
            $userReq['count']++;
            return true;
        }

        // 超出限制
        return false;
    }
}

// ** 複雜度分析 **
/*
 * 時間複雜度 (Time Complexity): O(1)，每次請求都是 O(1) 的查找和更新。
 * 空間複雜度 (Space Complexity): O(U)，U 為活躍的使用者數量。
 */
