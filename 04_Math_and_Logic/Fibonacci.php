<?php
/**
 * 演算法題庫 - 費波那契數列第 N 項
 * ----------------------------------------------------
 * 題目說明：計算費波那契數列第 N 項的值。
 * 難度：簡單/中等
 */

// ** 解法思路 (Markdown 格式) **
/*
# 解法思路 (使用迭代 / 動態規劃)
1.  **關鍵資料結構/演算法**: 迭代 / 動態規劃 (DP)
2.  **步驟**:
    -   初始化 a = 0, b = 1 (F(0) 和 F(1))。
    -   從 i = 2 循環到 N，計算 c = a + b。
    -   更新 a = b, b = c。
    -   返回最終的 b。
3.  **PHP 特性應用**: 簡單變數迭代，避免遞迴帶來的棧溢出和重複計算問題。
*/

class Solution {
    public function fib(int $n): int {
        if ($n <= 1) return $n;

        $a = 0;
        $b = 1;

        for ($i = 2; $i <= $n; $i++) {
            $c = $a + $b;
            $a = $b;
            $b = $c;
        }
        return $b;
    }
    public function solve($n) { return $this->fib($n); }
}

// ** 複雜度分析 **
/*
 * 時間複雜度 (Time Complexity): O(N)。
 * 空間複雜度 (Space Complexity): O(1)。
 */
