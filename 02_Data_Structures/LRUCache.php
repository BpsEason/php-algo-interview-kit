<?php

/**
 * 演算法題庫 - 實作 LRU Cache
 * ----------------------------------------------------
 * 題目說明：設計和實作一個最近最少使用 (LRU) 快取機制。所有操作 (get 和 put) 必須在 O(1) 時間內完成。
 * 難度：困難 (進階)
 */

// ** 解法思路 (Markdown 格式) **
/*
# 解法思路
1.  **關鍵資料結構/演算法**: HashMap (O(1) 查找) + 自定義雙向鏈表 (O(1) 節點移動)
2.  **結構設計**:
    -   `$cache`: HashMap，存儲 key => 節點數據。節點數據包含 ['value', 'prev', 'next']。
    -   `$head` 和 `$tail`: 兩個虛擬節點 (Dummy Nodes)，用於標記鏈表的頭和尾，簡化邊界條件處理。
3.  **核心操作 (O(1))**:
    -   `removeNode(key)`: 斷開 key 節點與其前後節點的連接，實現 O(1) 刪除。
    -   `addNodeToTail(key, value)`: 將新節點或被訪問節點插入到 $tail 之前，實現 O(1) 插入。
4.  **步驟**:
    -   **Get**: 若 key 存在，調用 `moveToTail`，返回 value。
    -   **Put**:
        -   若 key 存在：更新值，調用 `moveToTail`。
        -   若 key 不存在：
            -   插入新節點到尾部。
            -   若容量滿：移除 $head->next (最久未使用的節點)，從 $cache 中刪除其 key。
3.  **PHP 特性應用**: 使用 PHP 陣列作為高效的 HashMap，並用 $head、$tail 鍵值實現指標。
*/

class LRUCache
{
    private $capacity;
    private $cache = []; // HashMap: key => ['value', 'prev', 'next']
    private $head = 'head'; // 虛擬頭節點的鍵
    private $tail = 'tail'; // 虛擬尾節點的鍵

    public function __construct(int $capacity)
    {
        $this->capacity = $capacity;

        // 初始化雙向鏈表：head <-> tail
        $this->cache[$this->head] = ['value' => null, 'prev' => null, 'next' => $this->tail];
        $this->cache[$this->tail] = ['value' => null, 'prev' => $this->head, 'next' => null];
    }

    /**
     * 從鏈表中移除一個節點 (O(1))
     * @param string|int $key
     */
    private function removeNode($key): void
    {
        $prevKey = $this->cache[$key]['prev'];
        $nextKey = $this->cache[$key]['next'];

        // 更新前後節點的指標
        $this->cache[$prevKey]['next'] = $nextKey;
        $this->cache[$nextKey]['prev'] = $prevKey;

        // 從 HashMap 中移除
        unset($this->cache[$key]);
    }

    /**
     * 將節點插入到尾部 (tail 節點之前) (O(1))
     * @param string|int $key
     * @param mixed $value
     */
    private function addNodeToTail($key, $value): void
    {
        // 插入到 tail 的前一個節點 (last) 和 tail 之間
        $lastNodeKey = $this->cache[$this->tail]['prev'];

        // 1. 設置新節點的指標
        $this->cache[$key] = [
            'value' => $value,
            'prev' => $lastNodeKey,
            'next' => $this->tail
        ];

        // 2. 更新相鄰節點的指標
        $this->cache[$lastNodeKey]['next'] = $key;
        $this->cache[$this->tail]['prev'] = $key;
    }

    /**
     * 移動節點到尾部 (O(1))
     * @param string|int $key
     */
    private function moveToTail($key): void
    {
        $value = $this->cache[$key]['value'];
        $this->removeNode($key);
        $this->addNodeToTail($key, $value);
    }

    // =========================================================

    public function get(int $key): int
    {
        if (!isset($this->cache[$key])) {
            return -1;
        }

        // 1. 移到尾部 (表示最近使用)
        $this->moveToTail($key);

        // 2. 返回值
        return $this->cache[$this->cache[$this->tail]['prev']]['value'];
    }

    public function put(int $key, int $value): void
    {
        if (isset($this->cache[$key])) {
            // 1. 已存在：更新值，並將其移到尾部
            $this->cache[$key]['value'] = $value;
            $this->moveToTail($key);
        } else {
            // 2. 不存在：插入新節點

            // 2a. 檢查容量是否滿
            // 實際節點數是 count($this->cache) - 2 (減去 head 和 tail)
            if (count($this->cache) - 2 >= $this->capacity) {
                // 找到最久未使用的節點 (head 的下一個節點)
                $lruKey = $this->cache[$this->head]['next'];
                // 淘汰 LRU 節點
                $this->removeNode($lruKey);
            }

            // 2b. 插入新節點到尾部
            $this->addNodeToTail($key, $value);
        }
    }
}

// ** 複雜度分析 (修復後) **
/*
 * 時間複雜度 (Time Complexity): O(1)，所有 get/put 操作都包含 O(1) 的 HashMap 查找和 O(1) 的指標操作。
 * 空間複雜度 (Space Complexity): O(Capacity)，用於存儲 HashMap。
 */