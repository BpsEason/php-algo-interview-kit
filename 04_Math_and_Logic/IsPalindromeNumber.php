<?php
/**
 * 演算法題庫 - 判斷是否為迴文數字
 * ----------------------------------------------------
 * 題目說明：判斷一個整數是否是迴文數字 (Palindrome Number)，要求不轉換為字串。
 * 難度：簡單/中等
 */

// ** 解法思路 (Markdown 格式) **
/*
# 解法思路 (數學方式)
1.  **關鍵資料結構/演算法**: 數字反轉
2.  **步驟**:
    -   負數和個位數為 0 (非 0 本身) 的數不是迴文。
    -   只反轉數字的一半：創建一個 $reversedNumber，每次將 $x 的個位數取出並加入 $reversedNumber。
    -   當 $x <= $reversedNumber 時，表示只反轉了一半。
    -   比較 $x 是否等於 $reversedNumber (偶數位數) 或 $reversedNumber / 10 (奇數位數)。
3.  **PHP 特性應用**: 基本的數學運算 $x % 10 和 $x / 10。
*/

class Solution {
    public function isPalindrome(int $x): bool {
        // 負數或以 0 結尾的非 0 數字，都不是迴文
        if ($x < 0 || ($x % 10 == 0 && $x != 0)) {
            return false;
        }

        $reversedNumber = 0;
        while ($x > $reversedNumber) {
            $reversedNumber = $reversedNumber * 10 + $x % 10;
            $x = (int)($x / 10);
        }

        // 偶數位數: $x == $reversedNumber
        // 奇數位數: $x == $reversedNumber / 10 (去除中間位)
        return $x == $reversedNumber || $x == (int)($reversedNumber / 10);
    }
    public function solve($x) { return $this->isPalindrome($x); }
}

// ** 複雜度分析 **
/*
 * 時間複雜度 (Time Complexity): O(log N)，因為只處理了一半的位數。
 * 空間複雜度 (Space Complexity): O(1)。
 */
