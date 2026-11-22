<?php

namespace App\Services;

class MathCaptchaService
{
    /**
     * Generate a new random math question and store result in session.
     */
    public static function generate(string $type = 'login'): array
    {
        $num1 = rand(1, 10);
        $num2 = rand(1, 10);
        
        // Random operation: addition (+) or multiplication (x) or subtraction (-)
        $ops = ['+', '-', '+'];
        $op = $ops[array_rand($ops)];

        if ($op === '-') {
            // Ensure positive result
            if ($num1 < $num2) {
                [$num1, $num2] = [$num2, $num1];
            }
            $answer = $num1 - $num2;
        } else {
            $answer = $num1 + $num2;
        }

        $sessionKey = 'math_captcha_' . $type;
        session([$sessionKey => $answer]);

        return [
            'question' => "Berapa hasil dari {$num1} {$op} {$num2} ?",
            'num1'     => $num1,
            'op'       => $op,
            'num2'     => $num2,
        ];
    }

    /**
     * Validate the provided answer.
     */
    public static function validate(string $type, $answer): bool
    {
        $sessionKey = 'math_captcha_' . $type;
        $expected = session($sessionKey);

        if ($expected === null) {
            return false;
        }

        // Clean session after check
        session()->forget($sessionKey);

        return (int)$answer === (int)$expected;
    }
}
