<?php
/**
 * 演算法題庫 - 設計一個簡易的 Cache 系統 (帶有 TTL 和 FIFO 淘汰)
 * ----------------------------------------------------
 * 題目說明：實作一個具備 TTL (存活時間) 和 FIFO (先進先出) 淘汰策略的快取。
 * 難度：中等 (系統思維)
 */

// ** 解法思路 (Markdown 格式) **
/*
# 解法思路 (帶有 TTL 的 FIFO)
1.  **關鍵資料結構/演算法**: HashMap + 隊列 (Queue) / TTL (時間戳記)
2.  **步驟**:
    -   使用 $cache 存儲 key => ['value', 'expiry_time']。
    -   **Set**: 存儲 value 和 $expiry_time = time() + $ttl。
    -   **Get**:
        -   檢查 key 是否存在。
        -   檢查當前時間是否超過 $expiry_time。如果過期，則刪除並返回 null。
        -   如果未過期，返回 value。
    -   **FIFO 淘汰**: 如果容量滿了，刪除 $cache 中最早進入 (最低時間戳) 的元素。
3.  **PHP 特性應用**: 使用 time() 函數和陣列模擬快取結構。
*/

class SimpleCache {
    private $capacity;
    private $cache = []; // key => ['value' => mixed, 'expiry' => int]

    public function __construct(int $capacity) {
        $this->capacity = $capacity;
    }

    public function get(string $key) {
        if (!isset($this->cache[$key])) {
            return null;
        }

        if ($this->cache[$key]['expiry'] < time()) {
            // 已過期，刪除
            unset($this->cache[$key]);
            return null;
        }

        return $this->cache[$key]['value'];
    }

    public function set(string $key, $value, int $ttl): void {
        // 1. 如果已存在，直接更新
        if (isset($this->cache[$key])) {
            $this->cache[$key] = ['value' => $value, 'expiry' => time() + $ttl];
            return;
        }

        // 2. 檢查容量是否滿了 (FIFO 淘汰)
        if (count($this->cache) >= $this->capacity) {
            // 找到第一個 (最早進入) 的 key 進行淘汰 (模擬 FIFO)
            reset($this->cache);
            $keyToEliminate = key($this->cache);
            unset($this->cache[$keyToEliminate]);
        }

        // 3. 插入新元素
        $this->cache[$key] = ['value' => $value, 'expiry' => time() + $ttl];
    }
}

// ** 複雜度分析 **
/*
 * 時間複雜度 (Time Complexity): O(1) 攤提 (Set/Get 操作)。
 * 空間複雜度 (Space Complexity): O(Capacity)。
 */
