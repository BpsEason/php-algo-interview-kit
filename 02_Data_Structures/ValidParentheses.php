<?php
/**
 * 演算法題庫 - 判斷括號是否有效 (Valid Parentheses)
 * ----------------------------------------------------
 * 題目說明：判斷給定字串是否是有效的括號序列。
 * 難度：簡單
 */

// ** 解法思路 (Markdown 格式) **
/*
# 解法思路
1.  **關鍵資料結構/演算法**: 堆疊 (Stack)
2.  **步驟**:
    -   使用 Stack 存儲左括號。
    -   遍歷字串，遇到左括號 (([{) 則壓入 Stack。
    -   遇到右括號 (])}) 則檢查 Stack 是否為空且頂部元素是否與當前右括號匹配。
    -   匹配則彈出 Stack，不匹配或 Stack 為空則返回 false。
    -   遍歷結束後，若 Stack 為空，則有效，否則無效。
3.  **PHP 特性應用**: 使用 SplStack 實現高效堆疊操作。
*/

class Solution {
    public function isValid(string $s): bool {
        $stack = new SplStack();
        $map = [')' => '(', '}' => '{', ']' => '['];

        for ($i = 0; $i < strlen($s); $i++) {
            $char = $s[$i];
            if (isset($map[$char])) {
                // 右括號
                $topElement = $stack->isEmpty() ? '#' : $stack->pop();
                if ($topElement !== $map[$char]) {
                    return false;
                }
            } else {
                // 左括號
                $stack->push($char);
            }
        }
        return $stack->isEmpty();
    }
    public function solve($s) { return $this->isValid($s); }
}

// ** 複雜度分析 **
/*
 * 時間複雜度 (Time Complexity): O(N)，N為字串長度。
 * 空間複雜度 (Space Complexity): O(N)，最壞情況下 (如 "(((" ) Stack 會存儲 N/2 個元素。
 */
